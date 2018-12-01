<section class="search_sec">
  <div class="container">
      <div class="search_inner">
          <h2>Research Food that could lower your risk of cancer and fight existing <b class="c_green">cancer.</b></h2>
          <form action="<?php echo base_url('food/search'); ?>">
              <div class="input_wrap">
                  <input autocomplete="off" type="text" id="foodsearch" name="search" class="form-control  class="typeahead"" value="" placeholder="Type your keyword...">
                  <button class="btn search_btn">Submit</button>
              </div>
          </form>
      </div>

  </div>
</section>
<section class="recommended_products">
  <div class="container">
    <div class="heading">
      <h2>Featured Food</h2>
      <p>Featured Collection</p>
    </div>
    <div class="recommended_list">
      <div class="row">
        <?php 
        if(!empty($featured_foods)){
          foreach($featured_foods as $food){
          ?>
          <div class="col-sm-4 col-xs-6">
            <div class="recommended_item">
              <a href="<?php echo site_url('food/'.$food->slug); ?>">
                <div class="thumbnail_img">
                  <img src="<?php echo base_url('assets/images/'.$food->food_image); ?>" alt="" class="img-responsive">
                </div>
              </a>
              <a href="<?php echo site_url('food/'.$food->slug); ?>">
                <div class="item_info">
                  <h3><?php echo $food->title; ?></h3>
                </div>
              </a>
            </div>
          </div>
        <?php  } } ?>
      </div>
    </div>
  </div>
</section>