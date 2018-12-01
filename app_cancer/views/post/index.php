<section class="blog-grid">
      <div class="container">
        <div class="heading">
          <h2>Blog</h2>
          <p>Explore more</p>
        </div>
        <div class="row">
          <?php  foreach($posts as $post){ ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail blog-item">
                  <ul class="blog_date">
                    <li class="day"><?php echo formatDate($post->created_at, 'd'); ?></li>
                    <li class="month"><?php echo formatDate($post->created_at, 'M'); ?></li>
                  </ul>
                  <a href="<?php echo site_url('blog/'.$post->slug); ?>" class="blog_img"><img src="<?php echo base_url('assets/images/'.$post->featured_image); ?>" alt=""></a>
                  <div class="caption">
                    <h3><a href="<?php echo site_url('blog/'.$post->slug); ?>"><?php echo $post->title; ?></a></h3>
                    <div class="blog_content"><?php echo substr(strip_tags($post->description), 0, 120); ?>...</div>
                    <a href="<?php echo site_url('blog/'.$post->slug); ?>" class="btn btn-light" role="button">Read More</a>
                  </div>
                </div>
            </div>
          <?php } ?>
          
        </div>

      </div>
    </section>