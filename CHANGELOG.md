# Changelog

All notable changes to the Cloudflare UAM Automation project will be documented in this file.

## [3.3.1] - 2025-06-15

### 🚀 Major Performance & Reliability Update

#### Fixed
- **Plugin Trigger Logic**: Resolved issue where only cron was executing UAM logic
- **User Count Accuracy**: Plugin now uses same efficient session query as cron
- **Import Reliability**: Fixed XML import issues that could result in empty plugin code

#### Changed
- **Unified User Counting**: Both plugin and cron now use identical session-based counting:
  ```sql
  SELECT COUNT(*) FROM session WHERE lastactivity > (NOW - 900)
  ```
- **Performance Optimization**: Single optimized query instead of relying on `$totalonline` variable
- **Throttle Logic**: Plugin throttled to once per minute to prevent excessive API calls
- **Hook Placement**: Uses `forumhome_complete` for efficient homepage triggering

#### Added
- **Dual Automation System**: Plugin provides instant reaction + cron provides reliability
- **Enhanced Debugging**: Better error tracking and state logging
- **Improved AdminCP Status**: More detailed automation state information
- **Staff Notifications**: Visual UAM status for administrators and moderators

#### Technical Improvements
- **Database Efficiency**: Leverages existing session table indexes
- **API Call Optimization**: Reduced redundant Cloudflare API requests
- **Error Handling**: Enhanced error reporting in AdminCP and database logs
- **State Consistency**: Unified state tracking between plugin and cron

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

---

## Upgrade Notes

### From 3.1.1 to 3.3.1
- **Automatic**: Simply import the new XML file
- **Benefits**: Instant UAM reaction + improved reliability
- **No Breaking Changes**: Existing settings preserved

### Performance Impact
- **Minimal**: Single efficient database query per check
- **Optimized**: Uses existing session table indexes
- **Throttled**: Maximum one check per minute via plugin

### Compatibility
- **vBulletin 4.x**: All versions supported
- **PHP**: 5.6+ recommended
- **Cloudflare API**: v4 (current)
