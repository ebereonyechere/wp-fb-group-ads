<?php
$setting = get_option( $prefix . 'fb_app_secret' );

?>
<input type="text" name="<?php echo $prefix ?>fb_app_secret" value="<?php echo $setting ? $setting : '' ?>">
