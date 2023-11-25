<?php
/**
 * Plugin name: Authorizer SIU UPM module
 * Description: This plugin adds compatibility between Paul Ryan's Authorizer plugin and UPM's SSO.
 * Version: 1.0.0
 * Author: Pablo Fernández López
 * Author URI: https://github.com/Pablofl01/
 **/

 add_filter('authorizer_oauth2_generic_authorization_parameters', function() {
    return(array( 'scope' => 'openid profile email' ));
 });


 add_action('authorizer_user_register', function($user, $user_data) {
   wp_update_user([
      'ID' => $user->ID,
      'first_name' => $user_data['oauth2_attributes']['given_name'],
      'last_name' => $user_data['oauth2_attributes']['family_name']
   ]);
   update_user_meta($user->ID, 'school_code', '09');
   update_user_meta($user->ID, 'profile_type', 'Estudiante');
   return;
 }, 50, 2 );


 add_action( 'show_user_profile', 'upm_custom_fields' );
 add_action( 'edit_user_profile', 'upm_custom_fields' );
 
 function upm_custom_fields( $user ) {
 
    $school_code = get_user_meta( $user->ID, 'school_code', true );
    $profile_type = get_user_meta( $user->ID, 'profile_type', true );

    ?>
       <h3>Campos propios UPM</h3>
       <table class="form-table">
           <tr>
             <th><label for="school_code">Código de Escuela</label></th>
              <td>
                <input type="text" name="school_code" id="school_code" value="<?php echo esc_attr( $school_code ) ?>" class="regular-text" disabled=""/>
             </td>
          </tr>
          <tr>
             <th><label for="profile_type">Tipo de perfil</label></th>
              <td>
                <input type="text" name="profile_type" id="profile_type" value="<?php echo esc_attr( $profile_type ) ?>" class="regular-text" disabled=""/>
             </td>
          </tr>
       </table>
    <?php
 }
?>