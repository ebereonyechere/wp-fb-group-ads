<div class="form-field form-required">
<label for="group_id">Once Ad Price</label>
    <input type="number" name="ad_price_once" id="ad_price_once" size="40"
           value="<?php echo get_post_meta( $post->ID, 'ad_price_once', true ) ?>" required>
</div>
<div class="form-field form-required">
<label for="group_id">Weekly Ad Price</label>
    <input type="number" name="ad_price_weekly" id="ad_price_weekly" size="40"
           value="<?php echo get_post_meta( $post->ID, 'ad_price_weekly', true ) ?>" required>
</div>
<div class="form-field form-required">
<label for="group_id">Monthly Ad Price</label>
    <input type="number" name="ad_price_monthly" id="ad_price_monthly" size="40"
           value="<?php echo get_post_meta( $post->ID, 'ad_price_monthly', true ) ?>" required>
</div>
