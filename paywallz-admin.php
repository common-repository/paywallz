<?php
if ( !defined( 'ABSPATH' ) ) {
		exit;
}

require_once dirname( __FILE__ ) . '/paywallz-install.php';
require_once dirname( __FILE__ ) . '/paywallz-form.php';

add_action("admin_menu", 'pwlz_admin_pages');

function pwlz_admin_pages() {
	if(current_user_can( 'manage_options')) {
		add_menu_page( 'Paywallz', 'Paywallz', 'manage_options', 'paywallz.php', 'pwlz_setup', PAYWALL_FAVICON );
	}
}
