<?php $count = 1; ?>
<?php foreach( $ads as $ad ): ?>
    <?php
        $group = get_post( $ad[ 'group_id' ] )->post_title;
        $price = 0;
        switch ( $ad[ 'schedule' ] ) {
            case 'once':
                $price = get_post_meta( $ad[ 'group_id' ], 'ad_price_once', true );
                break;
            case 'daily':
                $price = ( get_post_meta( $ad[ 'group_id' ], 'ad_price_once', true ) * $ad[ 'times' ] );
                break;
            case 'weekly':
                $price = ( get_post_meta( $ad[ 'group_id' ], 'ad_price_weekly', true ) * $ad[ 'times' ] );
                break;
            case 'monthly':
                $price = ( get_post_meta( $ad[ 'group_id' ], 'ad_price_monthly', true ) * $ad[ 'times' ] );
                break;
        }
    ?>
    <tr><td colspan="2">
    <h4 style="margin-bottom: 20px">Ad Details</h4>
    <div style="margin-bottom: 15px">
            <h5 style="margin-bottom: 5px;">Ad # <?php echo $count ?></h5>
            <b>Group: </b><?php echo $group ?> <br>
            <b>Schedule: </b><?php echo $ad[ 'schedule' ]; ?> <br>
            <b>Times: </b>X<?php echo $ad[ 'times' ]; ?> times <br>
            <b>Content: </b><?php echo $ad[ 'content' ]; ?> <br>
            <b>Media: </b><?php echo $ad[ 'media' ] ? '<a href="'. $ad[ 'media' ] .'" target="_blank">View Media</a>' : 'none'; ?> <br>
            <b>Price: </b><?php echo '$'.$price; ?> <br>
        </div>
    </td></tr>
    
<?php $count++; ?>
<?php endforeach; ?>