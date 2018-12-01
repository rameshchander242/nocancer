<section class="search_result_sec">
      <div class="container">
          <h2 class="text-center">Search Results</h2>
          <h4 class="text-center"><?php echo empty($foods)?0:count($foods); ?> results found for "<?php echo $search; ?>"</h4>
          <div class="s_r_list">
            <div class="row">
            <?php 
              if(!empty($foods)){
                foreach($foods as $food){
            ?>
              <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                <div class="s_r_item">
                  <a href="<?php echo base_url('food/'.$food->slug); ?>">
                    <div class="thumbnail_img">
                      <div class="t_img_inner">
                        <img src="<?php echo base_url('assets/images/'.$food->food_image); ?>" alt="" class="img-responsive">
                      </div>
                    </div>
                    <div class="item_info">
                      <h3><?php echo $food->title; ?></h3>
                      <div class="btn read_more">Read More</div>
                    </div>
                  </a>
                </div>              
              </div>
            <?php } } ?>
              
            </div>
          </div>
      </div>
    </section>