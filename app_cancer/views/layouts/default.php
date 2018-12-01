<?php $this->load->view('layouts/header'); ?>
<body>
<header class="main-header">
	<?php $this->load->view('layouts/header_top'); ?>
</header>
<?php $this->load->view('layouts/search_section'); ?>
<?php $this->load->view($view_file); ?>

<?php $this->load->view('layouts/footer_bottom'); ?>
<?php $this->load->view('layouts/footer'); ?>
</body>
</html>