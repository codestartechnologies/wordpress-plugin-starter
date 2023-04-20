/**
 * public-ajax.js
 * https://github.com/codestartechnologies/wordpress-plugin-starter
 *
 * Copyright 2022 Codestar Technologies
 * Released under AGPL-3.0-or-later
 * https://www.gnu.org/licenses/agpl-3.0.en.html
 */

jQuery( function ( $ ) {

    // initialize wordpress i18n functions
    const { __ } = wp.i18n;

    // add event listener to "Click to make an AJAX request!" button
    jQuery( 'button[data-id="wps_public_ajax_btn"]' ).on( 'click', function ( evt ) {
        // stop default actions
        evt.preventDefault();
        evt.stopPropagation();
        // set up data that will be sent to the ajax request endpoint
        let req_data = {
            _ajax_nonce: WPS_PUBLIC_AJAX_REQUEST.nonce,
            action: WPS_PUBLIC_AJAX_REQUEST.action,
            wps_data: 'WPS'
        };
        // process the ajax request via post method
        $.post( WPS_PUBLIC_AJAX_REQUEST.ajax_url, req_data, function ( resp ) {
            if ( resp.success ) {
                if ( 'valid' === resp.data.msg ) {
                    alert( __( 'Congratulations! Your data is valid!', 'wps' ) );
                } else {
                    alert( __( 'Sorry! Your data is invalid!', 'wps' ) );
                }
            }
        } );
    });

} ) ;
