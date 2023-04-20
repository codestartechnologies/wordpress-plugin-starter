/**
 * admin-ajax.js
 * https://github.com/codestartechnologies/wordpress-plugin-starter
 *
 * Copyright 2022 Codestar Technologies
 * Released under AGPL-3.0-or-later
 * https://www.gnu.org/licenses/agpl-3.0.en.html
 */

jQuery( function ( $ ) {

    // initialize wordpress i18n functions
    const { __ } = wp.i18n;

    // add event listener to "Test Admin Ajax Request" button
    jQuery( 'button[data-id="wps_admin_ajax_btn"]' ).on( 'click', function ( evt ) {
        // stop default actions
        evt.preventDefault();
        evt.stopPropagation();
        // set up data that will be sent to the ajax request endpoint
        let req_data = {
            _ajax_nonce: WPS_ADMIN_AJAX_REQUEST.nonce,
            action: WPS_ADMIN_AJAX_REQUEST.action,
            wps_data: 'WPS'
        };
        // process the ajax request via post method
        $.post( WPS_ADMIN_AJAX_REQUEST.ajax_url, req_data, function ( resp ) {
            if ( resp.success ) {
                alert( resp.data.msg );
            }
        } );
    });

} ) ;
