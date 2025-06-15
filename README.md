# Cloudflare UAM Automation for vBulletin 4

Automatically enables/disables Cloudflare Under Attack Mode based on online user count in vBulletin 4 forums.

## Features

- 🔄 **Automatic UAM Control** - Enables UAM when online users exceed threshold
- ⏰ **Smart Cooldown** - Prevents rapid UAM toggling with configurable cooldown
- 📊 **Real-time Monitoring** - Displays current status in admin panel
- 🎯 **Dual Automation** - Plugin + cron for instant reaction and reliability
- 🚀 **Efficient Queries** - Optimized session count for minimal performance impact
- 📈 **Detailed Statistics** - Tracks automation checks, API calls, and actions
- 🔧 **Easy Configuration** - Simple admin panel settings
- 👨‍💼 **Staff Notifications** - Visual UAM status for admins and moderators

## Requirements

- vBulletin 4.x
- PHP with cURL support
- Cloudflare account with API access
- Valid Cloudflare Zone ID and API Token

## Quick Start

1. **Download** the latest release (`product-cfuam.xml`)
2. **Install** the product XML file in vBulletin Admin
3. **Upload** the cron file (`cfuam.php`) to `/includes/cron/`
4. **Configure** your Cloudflare credentials in AdminCP
5. **Set** your user threshold and cooldown period

## Installation

### Step 1: Install Product
1. Go to AdminCP → Plugins & Products → Manage Products
2. Click "Add/Import Product"
3. Upload `product-cfuam.xml`
4. Click "Import"

### Step 2: Upload Cron File
1. Upload `cfuam.php` to your `/includes/cron/` directory
2. Set file permissions to 644

### Step 3: Configure Settings
1. Go to AdminCP → vBulletin Options → Cloudflare UAM Automation
2. Enter your Cloudflare Zone ID and API Token
3. Set user threshold (e.g., 15000)
4. Set cooldown period (e.g., 10 minutes)
5. Enable automation

## How It Works

### Dual Automation System
- **Plugin Logic**: Instant reaction on forum page visits (throttled to once per minute)
- **Cron Job**: Reliable automation every 10 minutes regardless of site activity

### Process Flow
1. **Monitor** - Checks online user count via efficient session query
2. **Trigger** - When users exceed threshold, enables UAM immediately
3. **Cooldown** - Waits for users to drop below threshold for configured time
4. **Disable** - After cooldown period, disables UAM automatically

### User Counting Method
Uses the same efficient session-based counting as your cron:
```sql
SELECT COUNT(*) FROM session WHERE lastactivity > (NOW - 900)
```
This ensures accuracy and matches across all components.

## Admin Panel Status

The AdminCP homepage displays:
- **Current Cloudflare UAM Status** - Live API check
- **Online User Count** - Current vs threshold
- **Automation State** - Internal UAM tracking
- **Cooldown Timer** - Time remaining before UAM disable
- **Statistics** - Checks run, API calls, last actions
- **Configuration Check** - Validates API credentials

## Performance Optimization

- **Efficient Queries**: Single session count query, optimized for speed
- **Smart Throttling**: Plugin runs max once per minute to avoid overhead
- **Indexed Lookups**: Relies on existing session table indexes
- **Minimal DB Writes**: Only updates when state changes occur

## Configuration Options

| Setting | Description | Default |
|---------|-------------|---------|
| Enable Automation | Turn UAM automation on/off | Yes |
| User Threshold | Online users to trigger UAM | 15000 |
| Cooldown Minutes | Time below threshold before disable | 10 |
| Cloudflare Zone ID | Your domain's Zone ID | Required |
| Cloudflare API Token | API token with Zone:Settings:Edit | Required |

## Troubleshooting

### UAM Not Activating
- Check user count vs threshold in AdminCP
- Verify Cloudflare credentials are correct
- Ensure cron job is running (check AdminCP logs)

### UAM Not Deactivating
- Check cooldown timer in AdminCP status
- Verify users have actually dropped below threshold
- Check last API result for errors

### Plugin vs Cron Issues
- Plugin provides instant reaction on page visits
- Cron provides reliable background automation
- Both use identical logic for consistency

## API Permissions

Your Cloudflare API Token needs:
- **Zone Resources**: Include your specific zone
- **Zone Permissions**: Zone Settings:Edit
- **Account Permissions**: Not required

## Version History

**Current: 3.3.1**
- Efficient session-based user counting
- Fixed plugin trigger logic reliability
- Improved performance optimization
- Enhanced AdminCP status display

## Support

- 📖 [Documentation](docs/)
- 🐛 [Report Issues](https://github.com/z3r010/Cloudflare-UAM-Automation/issues)
- 💡 [Feature Requests](https://github.com/z3r010/Cloudflare-UAM-Automation/issues/new)

## License

MIT License - see [LICENSE](LICENSE) file for details.

---

*Developed for vBulletin 4 communities to automatically protect against traffic spikes*
