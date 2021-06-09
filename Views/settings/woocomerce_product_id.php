<?php
$setting = get_option( $prefix . 'woocomerce_product_id' );

?>
<input type="number" name="<?php echo $prefix ?>woocomerce_product_id" value="<?php echo $setting ? $setting : '' ?>">
