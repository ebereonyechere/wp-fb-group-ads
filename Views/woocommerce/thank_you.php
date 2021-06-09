<?php $count = 1; ?>
<?php foreach( $ads as $ad ): ?>
    <?php
        $group = get_post( $ad[ 'group_id' ] )->post_title;
    ?>
    <h4 style="margin-bottom: 20px; margin-top: 20px;">Ad Details</h4>
    <div style="margin-bottom: 15px">
        <h5 style="margin-bottom: 5px;">Ad # <?php echo $count ?></h5>
        <b>Group: </b><?php echo $group ?> <br>
        <b>Schedule: </b><?php echo $ad[ 'schedule' ]; ?> <br>
        <b>Times: </b>X<?php echo $ad[ 'times' ]; ?> times <br>
        <b>Content: </b><?php echo $ad[ 'content' ]; ?> <br>
        <b>Media: </b><?php echo $ad[ 'media' ] ? '<a href="'. $ad[ 'media' ] .'" target="_blank">View Media</a>' : 'none'; ?> <br>
    </div>
    
<?php $count++; ?>
<?php endforeach; ?>

<p><b>Your ad will be published automatically once it has been reviewed and approved.</b></p>