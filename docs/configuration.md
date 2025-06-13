# Configuration Guide

Complete setup guide for configuring Cloudflare credentials and fine-tuning automation settings.

## Prerequisites

- ✅ Plugin installed successfully
- ✅ Cloudflare account with domain added
- ✅ Domain DNS pointing through Cloudflare (orange cloud)

## Step 1: Get Cloudflare Zone ID

1. **Login to Cloudflare Dashboard**
   - Go to [dash.cloudflare.com](https://dash.cloudflare.com)
   - Select your domain

2. **Find Zone ID**
   - Scroll down to the "API" section on the right sidebar
   - Copy the "Zone ID" (format: `abc123def456...`)

## Step 2: Create API Token

1. **Access API Tokens**
   - In Cloudflare dashboard, go to "My Profile" (top right)
   - Click "API Tokens" tab
   - Click "Create Token"

2. **Use Custom Token**
   - Click "Custom token" → "Get started"

3. **Configure Token Permissions**
   ```
   Token name: vBulletin UAM Automation
   
   Permissions:
   - Zone : Zone Settings : Edit
   
   Zone Resources:
   - Include : Specific zone : [Select your domain]
   
   Client IP Address Filtering: (leave blank)
   TTL: (leave default or set expiration)
   ```

4. **Create and Copy Token**
   - Click "Continue to summary"
   - Click "Create Token"
   - **IMPORTANT**: Copy the token immediately (starts with `cfuat_...`)
   - Store it securely - you won't see it again!

## Step 3: Configure Plugin Settings

1. **Access Settings**
   - vBulletin Admin → `vBulletin Options` → `Cloudflare UAM Automation`

2. **Enter Cloudflare Credentials**
   ```
   Enable Cloudflare UAM Automation: Yes
   User Threshold to Enable UAM: 15000 (adjust to your needs)
   Minutes Below Threshold to Disable UAM: 10
   Cloudflare Zone ID: [paste your Zone ID]
   Cloudflare API Token: [paste your API token]
   ```

3. **Save Configuration**

## Step 4: Test Configuration

1. **Check Status Display**
   - Go to Admin Panel main page
   - Look at "Cloudflare UAM Automation" status

2. **Verify Connection**
   - Should show current Cloudflare security level
   - Should display "Under Attack Mode OFF" (or current status)
   - No connection errors should appear

3. **Test API Connection**
   - If you see errors like "HTTP 401" → Check API token
   - If you see errors like "HTTP 404" → Check Zone ID
   - If you see "Connection Error" → Check server cURL/internet

## Configuration Options Explained

### User Threshold
- **Purpose**: Online user count that triggers UAM activation
- **Recommendation**: Set 20-30% above your normal peak traffic
- **Example**: If you normally have 10k users, set to 12k-13k

### Cooldown Period
- **Purpose**: Minutes to wait below threshold before disabling UAM
- **Recommendation**: 5-15 minutes depending on traffic patterns
- **Prevents**: Rapid UAM on/off cycling during traffic fluctuations

### Automation Enable/Disable
- **Purpose**: Master switch for the entire automation
- **Usage**: Disable during maintenance or manual control periods

## Fine-Tuning Tips

### For High Traffic Sites
```
Threshold: Higher value (20k+ users)
Cooldown: Longer period (15-20 minutes)
```

### For Smaller Communities
```
Threshold: Lower value (1k-5k users)
Cooldown: Shorter period (5-10 minutes)
```

### For Variable Traffic
```
Threshold: Conservative (lower value)
Cooldown: Moderate (10-15 minutes)
```

## Monitoring Your Settings

### Check These Regularly
- Online user count vs threshold ratio
- Frequency of UAM activations
- API call count and success rate
- Last actions and timestamps

### Adjust If Needed
- **Too many activations**: Increase threshold
- **UAM not activating**: Lower threshold
- **Rapid cycling**: Increase cooldown
- **Slow response**: Decrease cooldown

## Security Best Practices

### API Token Security
- ✅ Use minimum required permissions
- ✅ Set token expiration if possible
- ✅ Monitor token usage in Cloudflare
- ✅ Regenerate tokens periodically

### Access Control
- ✅ Limit admin access to plugin settings
- ✅ Monitor automation logs regularly
- ✅ Test changes in low-traffic periods

## Next Steps

- Monitor the automation for a few days
- Adjust thresholds based on actual traffic patterns
- See [Troubleshooting Guide](troubleshooting.md) for common issues