<?php
// Retrieve current settings from the database
$notification_email = get_option('malware_scanner_notification_email', '');
$schedule_frequency = get_option('malware_scanner_schedule_frequency', 'daily');
$scan_log_retention = get_option('malware_scanner_scan_log_retention', '30');
$scan_sensitivity_level = get_option('malware_scanner_scan_sensitivity_level', 'medium');
$exclude_files = get_option('malware_scanner_exclude_files', '');
$email_alerts = get_option('malware_scanner_email_alerts', '1'); // Default to enabled (1)

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize error messages array
    $errors = [];

    // Validate and sanitize inputs
    $notification_email = sanitize_email($_POST['notification_email']);
    if (!is_email($notification_email)) {
        $errors[] = 'Please enter a valid email address.';
    }

    $schedule_frequency = sanitize_text_field($_POST['schedule_frequency']);
    $valid_frequencies = ['daily', 'weekly', 'monthly'];
    if (!in_array($schedule_frequency, $valid_frequencies)) {
        $errors[] = 'Invalid schedule frequency selected.';
    }

    $scan_log_retention = sanitize_text_field($_POST['scan_log_retention']);
    if (!in_array($scan_log_retention, ['7', '30', '60'])) {
        $errors[] = 'Invalid log retention period selected.';
    }

    $scan_sensitivity_level = sanitize_text_field($_POST['scan_sensitivity_level']);
    $valid_sensitivities = ['low', 'medium', 'high'];
    if (!in_array($scan_sensitivity_level, $valid_sensitivities)) {
        $errors[] = 'Invalid scan sensitivity level selected.';
    }

    $exclude_files = sanitize_textarea_field($_POST['exclude_files']);

    // Update settings if no errors
    if (empty($errors)) {
        update_option('malware_scanner_notification_email', $notification_email);
        update_option('malware_scanner_schedule_frequency', $schedule_frequency);
        update_option('malware_scanner_scan_log_retention', $scan_log_retention);
        update_option('malware_scanner_scan_sensitivity_level', $scan_sensitivity_level);
        update_option('malware_scanner_exclude_files', $exclude_files);
        update_option('malware_scanner_email_alerts', isset($_POST['email_alerts']) ? '1' : '0');

        echo '<div class="updated"><p>Settings saved successfully!</p></div>';
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo '<div class="error"><p>' . esc_html($error) . '</p></div>';
        }
    }
}
?>

<h1>Malware Scanner Settings</h1>

<form method="post" action="">
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Notification Email</th>
            <td>
                <input type="email" name="notification_email" value="<?php echo esc_attr($notification_email); ?>" />
                <p class="description">Enter the email address where notifications will be sent.</p>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Schedule Frequency</th>
            <td>
                <select name="schedule_frequency">
                    <option value="daily" <?php selected($schedule_frequency, 'daily'); ?>>Daily</option>
                    <option value="weekly" <?php selected($schedule_frequency, 'weekly'); ?>>Weekly</option>
                    <option value="monthly" <?php selected($schedule_frequency, 'monthly'); ?>>Monthly</option>
                </select>
                <p class="description">Select how frequently the automated scans should run.</p>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Scan Log Retention</th>
            <td>
                <select name="scan_log_retention">
                    <option value="7" <?php selected($scan_log_retention, '7'); ?>>7 days</option>
                    <option value="30" <?php selected($scan_log_retention, '30'); ?>>30 days</option>
                    <option value="60" <?php selected($scan_log_retention, '60'); ?>>60 days</option>
                </select>
                <p class="description">How long should scan logs be retained before deletion?</p>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Scan Sensitivity Level</th>
            <td>
                <select name="scan_sensitivity_level">
                    <option value="low" <?php selected($scan_sensitivity_level, 'low'); ?>>Low</option>
                    <option value="medium" <?php selected($scan_sensitivity_level, 'medium'); ?>>Medium</option>
                    <option value="high" <?php selected($scan_sensitivity_level, 'high'); ?>>High</option>
                </select>
                <p class="description">Choose the sensitivity level for scans.</p>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Exclude Files</th>
            <td>
                <textarea name="exclude_files" rows="5" cols="50"><?php echo esc_textarea($exclude_files); ?></textarea>
                <p class="description">Enter file paths or directories to exclude from scans, one per line.</p>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Email Alerts</th>
            <td>
                <label><input type="checkbox" name="email_alerts" value="1" <?php checked($email_alerts, '1'); ?> /> Enable email alerts</label>
                <p class="description">Enable or disable email alerts for scan results and critical issues.</p>
            </td>
        </tr>
    </table>

    <?php submit_button(); ?>
</form>