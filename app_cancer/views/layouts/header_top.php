<?php
  $menu_links = array(
    '/' => 'Home',
    'about-us' => 'About us',
    'blog' => 'Blog',
  );
?>

<nav class="navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>"><b>No</b>Cancer</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <?php 
        foreach($menu_links as $link=>$title){
          $active = ($link ==$this->uri->segment(1) || $link=='/')?'active':'';
          echo '<li><a href="'.site_url($link),'" class="'.$active.'">'.$title.'</a></li>';
        } 
        ?>
      </ul>
    </div>
  </div>
</nav>