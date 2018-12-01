<?php $this->load->view('admin/layouts/header'); ?>
<body class="hold-transition login-page">
<div class="login-box">
	<?php $this->load->view($view_file); ?>
  
</div>


	<script src="<?php echo base_url('assets/dist/jquery/dist/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/dist/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/dist/bootstrap/dist/iCheck/icheck.min.js'); ?>"></script>
	<script>
	  $(function () {
	    $('input').iCheck({
	      checkboxClass: 'icheckbox_square-blue',
	      radioClass: 'iradio_square-blue',
	      increaseArea: '20%' /* optional */
	    });
	  });
	</script>
</body>
</html>