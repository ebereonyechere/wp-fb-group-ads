<div class="submitbox" id="submitpost">
    <div id="major-publishing-actions">
		<?php
		do_action( 'post_submitbox_start' );
		?>
        <div id="delete-action">
			<?php
			if ( current_user_can( "delete_post", $post->ID ) ) :
				if ( ! EMPTY_TRASH_DAYS ) {
					$delete_text = __( 'Delete Permanently' );
				} else {
					$delete_text = __( 'Move to Trash' );
				}
				?>
                <a class="submitdelete deletion"
                   href="<?php echo get_delete_post_link( $post->ID ); ?>"><?php echo $delete_text; ?></a>
			<?php endif; ?>
        </div>
        <div id="publishing-action">
            <span class="spinner"></span>
			<?php
			if ( ! in_array( $post->post_status, array( 'publish', 'future', 'private' ) ) || 0 == $post->ID ) :
				if ( $can_publish ) : ?>
                    <input name="original_publish" type="hidden" id="original_publish"
                           value="<?php esc_attr_e( 'Add Tab' ) ?>"/>
					<?php submit_button( 'Save FB Group', 'primary button-large', 'publish', false, array( 'accesskey' => 'p' ) ); ?>
				<?php
				endif;
			else : ?>
                <input name="original_publish" type="hidden" id="original_publish" value="Update FB Group"/>
                <input name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p"
                       value="Update FB Group"/>
			<?php endif; ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
