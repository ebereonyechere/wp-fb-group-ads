<div class="container">
    <h3 class="text-center mb-5">Buy Our Facebook Group Ads</h3>

    <p id="ad_added_text" style="color:green; display: none;">Ad Added sucessfully, Proceed to add another</p>

    <form action="">
        <div class="form-group">
            <label for="" class="text-capitalize">Choose Facebook Group to post your ad</label> <br> <br>
            <div class="row">
                <?php 
                    $groups = get_posts( [
                        'numberposts' => '-1',
                        'post_type' => 'fb_group'
                    ] );
                ?>
                <?php foreach( $groups as $group ) : ?>
                    <div class="col-sm-3 fb-buy-ad-select-group p-2" data-bs-toggle="modal" data-bs-target="#buy_ad_modal" onclick="fb_buy_ads_set_group_id('<?php echo $group->ID ?>')">
                        <img src="<?php echo \Facebook_Group_Ads\Plugin::get_instance()->get_url() . 'Assets/images/facebook.png' ?>" alt="">
                        <p class="text-center"><?php echo $group->post_title ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </form>
</div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="buy_ad_modal" tabindex="-1" aria-labelledby="buy_ad_modal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" style="max-width: 100%;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buy_ad_modal-label">Configure Ad Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Ad Schedule</label>
            <select name="schedule" id="ad_schedule" class="form-control">
                <option value="once">Once</option>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Number of Times</label>
            <input type="number" class="form-control" id="ad_times" value="1">
            <div class="help-text" style="font-size: 14px;">This is the number of times the ad will be posted in relation to the schdule.EG. If you chose daily and input 3 here, your ad will be posted once a day for 3 days. If you chose weekly and input 4 here, your ad will be posted once a week for 4 weeks. If you chose once, your ad will only be posted once.</div>
        </div>
        <div class="form-group">
            <label for="">AD Content</label>
            <textarea name="" cols="20" rows="5" class="form-control" id="ad_content"></textarea>
        </div>
        <div class="form-group">
            <label for="">AD Media</label>
            <input type="file" class="form-control" id="ad_media" accept="image/*,video/*">
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" id="add_ad">Add Another Ad</button> -->
        <button type="button" class="btn btn-primary" id="submit_ad">Submit Ad Now</button>
      </div>
    </div>
  </div>
</div>