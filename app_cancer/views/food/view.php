<section class="result_sec">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-4">
        <div class="result_title">
          <h2><span><?php echo $food->title; ?></span></h2>
        </div>
        <h3>Ratings</h3>
        <?php 
          $rating_list = array_map('getSlug', (array)json_decode($this->config->config['nocancer']['rating']));
          $ratings = json_decode($food->rating);
          if(!empty($ratings)){
            foreach($ratings as $rating){
              $key = array_search(getSlug($rating), $rating_list);
              $key = empty($key)?'default':$key;
              echo '<button class="btn btn-'.$key.'">'.getTitle($rating).'</button>';
            }
          }
        ?>
      </div>
      <div class="col-xs-12 col-md-8">
        <div class="result_img">
          <img src="<?php echo base_url('assets/images/'.$food->food_image); ?>" alt="" class="img-responsive">
        </div>
      </div>
    </div>

    <div class="result_item_info">
      <div class="row">
        <div class="col-xs-12 col-md-4">
          <div class="left">
            <h4>Description</h4>
          </div>
        </div>
        <div class="col-xs-12 col-md-8">
          <div class="right">
            <?php echo $food->description; ?>
          </div>
        </div>

      </div>
    </div>

    <div class="result_item_info">
      <div class="row">
        <div class="col-xs-12 col-md-4">
          <div class="left">
            <p>Addional</p>
            <h4>Information</h4>
          </div>
        </div>
        <div class="col-xs-12 col-md-8">
          <div class="right">
            <?php echo $food->additional_information; ?>
          </div>
        </div>

      </div>
    </div>

    <div class="result_item_info">
      <div class="row">
        <div class="col-xs-12 col-md-4">
          <div class="left">
            <p>Recommendet</p>
            <h4>Products</h4>
          </div>
        </div>
        <div class="col-xs-12 col-md-8">
          <div class="right">
            <?php 
              $recomend_products = json_decode($food->recomend_products);
              if(!empty($recomend_products)){
                foreach($recomend_products as $recomend_product){
                  echo '<a href="#">'.$recomend_product.'</a>';
                }
              }
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="result_item_info">
      <div class="row">
        <div class="col-xs-12 col-md-4">
          <div class="left">
            <p>Information</p>
            <h4>Sources</h4>
          </div>
        </div>
        <div class="col-xs-12 col-md-8">
          <div class="right">
            <?php 
              $information_sources = json_decode($food->information_sources);
              if(!empty($information_sources)){
                foreach($information_sources as $information_source){
                  echo '<a href="#">'.$information_source.'</a>';
                }
              }
            ?>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>