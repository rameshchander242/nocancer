<section class="single_blog">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        
        <div class="blog_image">
          <ul class="blog_date">
            <li class="day"><?php echo formatDate($post->created_at, 'd'); ?></li>
            <li class="month"><?php echo formatDate($post->created_at, 'M'); ?></li>
          </ul>
          <img src="<?php echo base_url('assets/images/'.$post->featured_image); ?>" alt="" class="img-responsive">
        </div>

        <div class="blog_title"><h2><?php echo $post->title; ?></h2></div>
        <div class="blog_content"><?php echo $post->description; ?></div>
      </div>          
    </div>

  </div>
</section>