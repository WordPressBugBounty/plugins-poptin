<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( __( 'You do not have sufficient permissions to access this page.', 'poptin' ) );
}
?>

<section class="poptin-dashboard">
    <iframe
        class="poptin-dashboard-iframe"
        allow="clipboard-read; clipboard-write"
        src="<?php echo esc_url( poptin_get_iframe_url() ) ?>">
    </iframe>
</section>