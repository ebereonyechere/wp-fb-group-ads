<?php
$setting = get_option( $prefix . 'email' );

?>
<input type="text" name="<?php echo $prefix ?>email" value="<?php echo $setting ? $setting : '' ?>">
