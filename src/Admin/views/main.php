<div class="wrap">
    <h1 class="dashboard-title"><?php esc_html_e('Malware Scanner Dashboard', 'malware-scanner'); ?></h1>

    <!-- Overview Section: Summary of metrics -->
    <div class="overview-section">
        <div class="heading-row">
            <h2 class="section-title"><?php esc_html_e('Scan Metrics', 'malware-scanner'); ?></h2>
        </div>
        <div class="metric-boxes">
            <div class="metric-box">
                <span class="dashicons dashicons-calendar-alt icon"></span>
                <h3><?php esc_html_e('Last Scan Date', 'malware-scanner'); ?></h3>
                <p><?php echo esc_html($last_scan_date); ?></p>
            </div>
            <div class="metric-box">
                <span class="dashicons dashicons-media-text icon"></span>
                <h3><?php esc_html_e('Files Scanned', 'malware-scanner'); ?></h3>
                <p><?php echo esc_html($files_scanned); ?></p>
            </div>
            <div class="metric-box">
                <span class="dashicons dashicons-warning icon"></span>
                <h3><?php esc_html_e('Threats Detected', 'malware-scanner'); ?></h3>
                <p><?php echo esc_html($threats_detected); ?></p>
            </div>
            <div class="metric-box">
                <span class="dashicons dashicons-yes icon"></span>
                <h3><?php esc_html_e('Total Threats Resolved', 'malware-scanner'); ?></h3>
                <p><?php echo esc_html($threats_resolved); ?></p>
            </div>
            <div class="metric-box">
                <span class="dashicons dashicons-shield icon"></span>
                <h3><?php esc_html_e('Vulnerabilities Found', 'malware-scanner'); ?></h3>
                <p><?php echo esc_html($vulnerabilities_found); ?></p>
            </div>
        </div>
    </div>



    <!-- Scan Scheduling Section -->
    <div class="scan-scheduling-section">
        <div class="heading-box">
            <h2 class="section-title"><?php esc_html_e('Scheduled Scans', 'malware-scanner'); ?></h2>
        </div>
        <div class="schedule-box">
            <span class="dashicons dashicons-clock icon"></span>
            <p><?php esc_html_e('Next Scheduled Scan:', 'malware-scanner'); ?> <?php echo esc_html($next_scan_date); ?></p>&nbsp;&nbsp; | &nbsp;&nbsp;
            <p><?php esc_html_e('Frequency:', 'malware-scanner'); ?> <?php echo esc_html($scan_frequency); ?></p>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="recent-activity-section">
        <h2 class="section-title"><?php esc_html_e('Recent Activity Logs', 'malware-scanner'); ?></h2>
        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
                <tr>
                    <th><?php esc_html_e('Date', 'malware-scanner'); ?></th>
                    <th><?php esc_html_e('Event', 'malware-scanner'); ?></th>
                    <th><?php esc_html_e('Details', 'malware-scanner'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recent_logs as $log): ?>
                    <tr>
                        <td><?php echo esc_html($log['date']); ?></td>
                        <td><?php echo esc_html($log['event']); ?></td>
                        <td><?php echo esc_html($log['details']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- System Status Section -->
<div class="system-status-section">
    <h2 class="section-title"><?php esc_html_e('System Status', 'malware-scanner'); ?></h2>
    <p><?php esc_html_e('Here you can find the current status of your system, including the versions of PHP and WordPress you are running, as well as the active Yara rules for malware scanning. Keeping these components up to date is crucial for maintaining the security and performance of your site.', 'malware-scanner'); ?></p>
    <ul>
        <li><?php esc_html_e('PHP Version:', 'malware-scanner'); ?> <?php echo esc_html($php_version); ?></li>
        <li><?php esc_html_e('WordPress Version:', 'malware-scanner'); ?> <?php echo esc_html($wp_version); ?></li>
        <li><?php esc_html_e('Yara Rules Active:', 'malware-scanner'); ?> <?php echo esc_html($active_yara_rules); ?></li>
    </ul>
</div>


    <!-- Buttons to initiate actions -->
    <div class="actions-section">
        <button class="button-primary" onclick="location.href='<?php echo admin_url('admin.php?page=malware-scanner&tab=scanner'); ?>'">
            <?php esc_html_e('Run Scan Now', 'malware-scanner'); ?>
        </button>
        <button class="button-secondary" onclick="location.href='<?php echo admin_url('admin.php?page=malware-scanner&tab=schedule'); ?>'">
            <?php esc_html_e('Manage Schedule', 'malware-scanner'); ?>
        </button>
    </div>
</div>
