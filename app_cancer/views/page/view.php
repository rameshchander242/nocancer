<section class="result_sec">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="result_img">
          <img src="<?php echo base_url('assets/images/'.$page->featured_image); ?>" alt="" class="img-responsive">
        </div>
      </div>
      <div class="col-xs-12">
          <h2><span><?php echo $page->title; ?></span></h2>
      </div>
    </div>

    <div class="">
      <?php echo $page->description; ?>
    </div>

  </div>
</section>