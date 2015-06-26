<div class="wrap">
    <div class="mb-banner"><img src="<?php echo MB_PRODUCTS__PLUGIN_URL . '_inc/img/mindbody_banner.png'; ?>"></div><BR>
<h2>Mindbody API Credentials</h2>
<?php

if (isset($_POST['mb_sourcename']) || isset($_POST['mb_password']) || isset($_POST['mb_siteid'])) {
  update_option( 'mb_cred', 
          array('mb_sourcename'=>$_POST['mb_sourcename'], 
              'mb_password'=>$_POST['mb_password'],
              'mb_siteid'=>$_POST['mb_siteid']
          ));
?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php
}


?>
<form method="post" action="">
    <?php settings_fields( 'mb_tester' ); ?>
    <?php do_settings_sections( 'mindbody-config' ); ?>    
    <?php submit_button(); ?>

</form>

<form method="post" action="">
    <?php settings_fields( 'mb_tester' ); ?>
    <?php do_settings_sections( 'mindbody-update' ); ?> 

</form>