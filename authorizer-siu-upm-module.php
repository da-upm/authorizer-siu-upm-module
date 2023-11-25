<?php
/**
 * Plugin name: Authorizer SIU UPM module
 * Description: This plugin adds compatibility between Paul Ryan's Authorizer plugin and UPM's SSO.
 * Version: 1.0.0
 * Author: Pablo Fernández López
 * Author URI: https://github.com/Pablofl01/
 **/

 add_filter('authorizer_oauth2_generic_authorization_parameters', function () {
    return(array( 'scope' => 'openid profile email' ));
 });

?>