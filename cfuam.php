<?php
/*======================================================================*\
|| #################################################################### ||
|| # Cloudflare UAM Automation Cron Job - Every 10 Minutes           # ||
|| #################################################################### ||
\*======================================================================*/

if (!VB_AREA) exit;

// Load settings
$enable = intval($vbulletin->options['cfuam_enable']);
$threshold = intval($vbulletin->options['cfuam_threshold']);
$cooldown = intval($vbulletin->options['cfuam_cooldown']);
$zone_id = trim($vbulletin->options['cfuam_zoneid']);
$api_token = trim($vbulletin->options['cfuam_token']);

if (!$enable || !$zone_id || !$api_token || $threshold < 1) {
	log_cron_action('Cloudflare UAM: Not configured', $nextitem, 1);
	return;
}

// Get current state
$state = $vbulletin->db->query_first("SELECT * FROM " . TABLE_PREFIX . "cfuam_automation WHERE id = 1");
if (!$state) {
	log_cron_action('Cloudflare UAM: State table not found', $nextitem, 1);
	return;
}

// Update check counter
$vbulletin->db->query_write("UPDATE " . TABLE_PREFIX . "cfuam_automation SET checks_run = checks_run + 1, last_check = " . TIMENOW . " WHERE id = 1");

// Get current user count using cookie timeout method (matches homepage)
$timeout_cookie = TIMENOW - $vbulletin->options['cookietimeout'];
$online = $vbulletin->db->query_first("SELECT COUNT(*) AS total FROM " . TABLE_PREFIX . "session WHERE lastactivity > " . $timeout_cookie);
$usercount = intval($online['total']);

$vbulletin->db->query_write("UPDATE " . TABLE_PREFIX . "cfuam_automation SET last_users = " . $usercount . " WHERE id = 1");

$now = TIMENOW;
$action_message = '';

// Check threshold
if ($usercount > $threshold) {
	$vbulletin->db->query_write("UPDATE " . TABLE_PREFIX . "cfuam_automation SET last_high_time = " . $now . " WHERE id = 1");
	
	if (!$state['uam_active']) {
		// Enable UAM
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.cloudflare.com/client/v4/zones/$zone_id/settings/security_level");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{"value":"under_attack"}');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $api_token", "Content-Type: application/json"));
		
		$result = curl_exec($ch);
		$error = curl_error($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		if (!$error && $http_code == 200) {
			$response = json_decode($result, true);
			if (!empty($response['success'])) {
				$vbulletin->db->query_write("UPDATE " . TABLE_PREFIX . "cfuam_automation SET uam_active = 1, activation_time = " . $now . ", api_calls_made = api_calls_made + 1 WHERE id = 1");
				$action_message = 'UAM ENABLED - Users: ' . $usercount . ' > ' . $threshold;
			}
		}
	}
} else {
	// Check cooldown
	if ($state['uam_active'] && $state['last_high_time'] > 0 && ($now - $state['last_high_time'] >= $cooldown * 60)) {
		// Disable UAM
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.cloudflare.com/client/v4/zones/$zone_id/settings/security_level");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{"value":"high"}');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $api_token", "Content-Type: application/json"));
		
		$result = curl_exec($ch);
		$error = curl_error($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		if (!$error && $http_code == 200) {
			$response = json_decode($result, true);
			if (!empty($response['success'])) {
				$vbulletin->db->query_write("UPDATE " . TABLE_PREFIX . "cfuam_automation SET uam_active = 0, deactivation_time = " . $now . ", api_calls_made = api_calls_made + 1 WHERE id = 1");
				$action_message = 'UAM DISABLED - Cooldown expired';
			}
		}
	}
}

if ($action_message) {
	$vbulletin->db->query_write("UPDATE " . TABLE_PREFIX . "cfuam_automation SET last_action = '" . $vbulletin->db->escape_string($action_message) . "' WHERE id = 1");
}

log_cron_action('Cloudflare UAM: Users=' . $usercount . '/' . $threshold . ($action_message ? ' - ' . $action_message : ''), $nextitem, 1);
?>
