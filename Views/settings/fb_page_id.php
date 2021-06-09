<?php
$setting = get_option( $prefix . 'fb_page_id' );

?>
<input type="text" name="<?php echo $prefix ?>fb_page_id" value="<?php echo $setting ? $setting : '' ?>">
