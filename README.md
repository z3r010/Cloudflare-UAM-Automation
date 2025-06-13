# Cloudflare UAM Automation for vBulletin 4

Automatically enables/disables Cloudflare Under Attack Mode based on online user count in vBulletin 4 forums.

## Features

- 🔄 **Automatic UAM Control** - Enables UAM when online users exceed threshold
- ⏰ **Smart Cooldown** - Prevents rapid UAM toggling with configurable cooldown
- 📊 **Real-time Monitoring** - Displays current status in admin panel
- 🎯 **Accurate Counting** - Uses same user counting method as your homepage
- 📈 **Detailed Statistics** - Tracks automation checks, API calls, and actions
- 🔧 **Easy Configuration** - Simple admin panel settings

## Requirements

- vBulletin 4.x
- PHP with cURL support
- Cloudflare account with API access
- Valid Cloudflare Zone ID and API Token

## Quick Start

1. **Download** the latest release
2. **Install** the product XML file in vBulletin Admin
3. **Upload** the cron file to your server
4. **Configure** your Cloudflare credentials
5. **Set** your user threshold and cooldown

## Installation

See [Installation Guide](docs/installation.md) for detailed instructions.

## Configuration

See [Configuration Guide](docs/configuration.md) for setup details.

## How It Works

1. **Monitor** - Checks online user count every 5 minutes
2. **Trigger** - When users exceed threshold, enables UAM
3. **Cooldown** - Waits for users to drop below threshold
4. **Disable** - After cooldown period, disables UAM automatically

## Status Display

The admin panel shows:
- Current Cloudflare UAM status
- Online user count vs threshold
- Automation state and cooldown timer
- Statistics and last actions

## Support

- 📖 [Documentation](docs/)
- 🐛 [Report Issues](https://github.com/z3r010/Cloudflare-UAM-Automation/issues)
- 💡 [Feature Requests](https://github.com/z3r010/Cloudflare-UAM-Automation/issues/new)

## License

MIT License - see [LICENSE](LICENSE) file for details.

## Version

Current version: **3.1.0**

---

*Developed for vBulletin 4 communities to automatically protect against traffic spikes*