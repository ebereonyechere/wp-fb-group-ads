<div class="form-field form-required">
<label for="group_id">FB Group ID</label>
    <input type="text" name="group_id" id="group_id" size="40"
           value="<?php echo get_post_meta( $post->ID, 'group_id', true ) ?>" required>
</div>
