# Installation Guide

Follow these steps to install the Cloudflare UAM Automation plugin on your vBulletin 4 forum.

## Prerequisites

Before installing, ensure you have:

- ✅ vBulletin 4.x installed and working
- ✅ Admin access to your vBulletin forum
- ✅ FTP/File access to your server
- ✅ PHP with cURL extension enabled
- ✅ Cloudflare account with your domain added

## Step 1: Download Files

Download the latest release from GitHub:
1. Go to [Releases](https://github.com/z3r010/Cloudflare-UAM-Automation/releases)
2. Download the latest version
3. Extract the files to your computer

## Step 2: Install vBulletin Product

1. **Access Admin Panel**
   - Login to your vBulletin Admin Control Panel
   - Go to `Plugins & Products` → `Manage Products`

2. **Import Product**
   - Click "Add/Import Product"
   - Choose "Import Product from XML file"
   - Select `product-cfuam.xml`
   - Click "Import"

3. **Verify Installation**
   - You should see "Cloudflare UAM Automation installed successfully!"
   - The product should appear in your products list

## Step 3: Upload Cron File

1. **Connect to Your Server**
   - Use FTP, SFTP, or your hosting panel's file manager
   - Navigate to your vBulletin installation directory

2. **Create Directory Structure**
   ```
   your-vbulletin-folder/
   └── includes/
       └── cron/
           └── cfuam.php  ← Upload this file here
   ```

3. **Upload File**
   - Upload `cfuam.php` to the `includes/cron/` directory
   - Ensure file permissions are set correctly (typically 644)

## Step 4: Verify Cron Job

1. **Check Cron Manager**
   - In Admin Panel: `Scheduled Tasks` → `Scheduled Task Manager`
   - Look for "Cloudflare UAM Automation Cron"
   - Should be set to run every 5 minutes

2. **Test Cron Execution**
   - Click on the cron job name
   - Click "Execute Now" to test
   - Check for any error messages

## Step 5: Initial Configuration

1. **Access Settings**
   - Go to `vBulletin Options` → `Cloudflare UAM Automation`

2. **Configure Basic Settings**
   - **Enable Automation**: Set to "Yes"
   - **User Threshold**: Set your desired threshold (e.g., 15000)
   - **Cooldown Minutes**: Set cooldown period (e.g., 10)
   - Leave Zone ID and API Token blank for now

3. **Save Settings**

## Step 6: Check Status Display

1. **View Admin Dashboard**
   - Go to your main Admin Panel home page
   - You should see the "Cloudflare UAM Automation" status box

2. **Verify Display**
   - Should show "Configuration Required"
   - Online user count should match your homepage
   - Statistics should show automation checks

## Next Steps

- Continue to [Configuration Guide](configuration.md) to set up Cloudflare credentials
- See [Troubleshooting Guide](troubleshooting.md) if you encounter issues

## Uninstallation

To remove the plugin:

1. **Remove Product**
   - Admin Panel → `Plugins & Products` → `Manage Products`
   - Find "Cloudflare UAM Automation"
   - Click delete and confirm

2. **Remove Files**
   - Delete `includes/cron/cfuam.php` from your server

The database table will be automatically removed when uninstalling the product.