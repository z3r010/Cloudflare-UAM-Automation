# Changelog
## [3.1.1] - 2025-06-13

### Fixed
- Corrected cron scheduling to use 10-minute intervals (0,10,20,30,40,50) 
- vBulletin 4 only supports 10-minute minimum intervals for cron jobs
- Added missing `<options>` section to XML for proper settings display

### Changed
- Cron now runs every 10 minutes instead of every 5 minutes
- Updated documentation to reflect 10-minute scheduling

## [3.1.0] - 2025-06-13

### Added
- Complete repository structure and documentation
- Automatic UAM control based on online user count
- Smart cooldown system to prevent rapid toggling
- Real-time status monitoring in admin panel
- Detailed statistics tracking
- Cookie timeout method for accurate user counting (matches homepage)

### Features
- Configurable user threshold for UAM activation
- Configurable cooldown period after threshold drops
- Comprehensive error handling and logging
- Clean admin panel interface without Unicode characters
- Cron job automation every 10 minutes

### Technical Details
- Uses Cloudflare API v4 for UAM control
- Database tracking of automation state
- Session-based user counting with cookie timeout
- Proper SQL escaping and error handling

All notable changes to the Cloudflare UAM Automation project will be documented in this file.

## [3.1.0] - 2025-06-13

### Added
- Complete repository structure and documentation
- Automatic UAM control based on online user count
- Smart cooldown system to prevent rapid toggling
- Real-time status monitoring in admin panel
- Detailed statistics tracking
- Cookie timeout method for accurate user counting (matches homepage)

### Features
- Configurable user threshold for UAM activation
- Configurable cooldown period after threshold drops
- Comprehensive error handling and logging
- Clean admin panel interface without Unicode characters
- Cron job automation every 5 minutes

### Technical Details
- Uses Cloudflare API v4 for UAM control
- Database tracking of automation state
- Session-based user counting with cookie timeout
- Proper SQL escaping and error handling

## [3.0.1] - 2025-06-13

### Added
- Debug mode for testing different user counting methods
- Comparison of various online user counting approaches

### Fixed
- User counting method to match homepage display

## [3.0.0] - 2025-06-13

### Added
- Initial release of Cloudflare UAM Automation
- Basic UAM enable/disable functionality
- Admin panel status display
- Configuration settings

### Changed
- Removed Unicode emoji characters for vBulletin 4 compatibility
- Standardized file names for easier management

- # Changelog

All notable changes to the Cloudflare UAM Automation project will be documented in this file.

