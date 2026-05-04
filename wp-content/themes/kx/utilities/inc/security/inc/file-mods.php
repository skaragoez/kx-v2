<?php

/**
 * File modifications (plugin/theme install, updates, editors) follow WordPress core
 * and wp-config (e.g. DISALLOW_FILE_MODS). No extra lockdown in this theme.
 */

add_filter( 'security_checks', function ( $checks ) {
	$checks['file_mods'] = [
		'title'       => __( 'File modifications', 'security' ),
		'status'      => $status = wp_is_file_mod_allowed( 'capability_update_core' )
			? ((isLocal() && !get_option( 'loose_security' )) ? 'warning' : false) : true,
		'info'        => $status === true
			? __( 'No file modifications via backend are allowed.', 'security' )
			: sprintf(
				__( 'File modifications via backend are allowed.%s', 'security' ),
				($status == 'warning' ? ' ' . __( "But in the development environment it always is. Please check on <i>stage</i> and <i>live</i>!", 'security' ) : '')
			),
		'description' => __( 'If allowed, admins can install or update plugins and themes, translations, and use file editors from the dashboard. Restricting file mods (WordPress DISALLOW_FILE_MODS or server policy) limits damage if an account is compromised.', 'security' )
	];

	return $checks;
} );
