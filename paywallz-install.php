<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

function pwlz_activate() {
  add_option(PAYWALLZ_OPTION_KEY, '');
}

function pwlz_deactivate() {
  delete_option(PAYWALLZ_OPTION_KEY);
}
