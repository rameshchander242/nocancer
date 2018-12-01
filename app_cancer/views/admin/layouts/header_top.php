<header class="main-header">
    <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo">
      <span class="logo-mini"><b>N</b>C</span>
      <span class="logo-lg"><b>No</b>Cancer</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>  
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#">
              <i class="fa fa-user"></i>
              <span class="hidden-xs"><?php echo $this->session->userdata('identity'); ?></span>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/auth/logout'); ?>" class="btn btn-danger"><i class="fa fa-logout"></i>Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>