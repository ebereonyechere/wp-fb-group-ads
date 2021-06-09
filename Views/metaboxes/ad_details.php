<?php $count = 1; ?>
<?php foreach( get_post_meta( $post->ID, '_ad_data', true ) as $ad ): ?>
    <?php
        $group = get_post( $ad[ 'group_id' ] )->post_title;
    ?>
    <!-- <tr><td colspan="2"> -->
    <div style="margin-bottom: 15px">
            <h4 style="margin-bottom: 5px;">Ad # <?php echo $count ?></h4>
            <b>Group: </b><?php echo $group ?> <br>
            <b>Schedule: </b><?php echo $ad[ 'schedule' ]; ?> <br>
            <b>Times: </b>X<?php echo $ad[ 'times' ]; ?> times <br>
            <b>Content: </b><?php echo $ad[ 'content' ]; ?> <br>
            <b>Media: </b><?php echo $ad[ 'media' ] ? '<a href="'. $ad[ 'media' ] .'" target="_blank">View Media</a>' : 'none'; ?> <br>
        </div>
    <!-- </td></tr> -->
    
<?php $count++; ?>
<?php endforeach; ?>

<div>
    <?php if ( ! get_post_meta( $post->ID, '_ad_published', true ) ): ?>
        <a href="<?php echo admin_url( 'edit.php?post_type=fb_group&page=settings&publish=' . $post->ID ); ?>" class="button button-primary">Approve & Publish</a>
    <?php else: ?>
        <p style="color: green;">Ad has been published.</p>
    <?php endif; ?>
</div>