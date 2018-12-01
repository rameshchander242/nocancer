<?php $this->load->view('layouts/header'); ?>
<body class="home">
<header class="main-header">
	<?php $this->load->view('layouts/header_top'); ?>
</header>
<?php $this->load->view($view_file); ?>

<?php $this->load->view('layouts/footer_bottom'); ?>
<?php $this->load->view('layouts/footer'); ?>
</body>
</html>