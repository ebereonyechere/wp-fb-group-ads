<?php
$setting = get_option( $prefix . 'fb_app_id' );

?>
<input type="text" name="<?php echo $prefix ?>fb_app_id" value="<?php echo $setting ? $setting : '' ?>">
