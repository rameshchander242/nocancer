<?php $this->load->view('admin/layouts/header'); ?>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view('admin/layouts/header_top'); ?>
		<?php $this->load->view('admin/layouts/sidebar'); ?>
			<div class="content-wrapper">
  			<?php
  				$danger = isset($danger)?$danger:($this->session->flashdata('danger')?$this->session->flashdata('danger'):'');
  				$success = isset($success)?$success:($this->session->flashdata('success')?$this->session->flashdata('success'):'');
  			?>
				<?php if(isset($message) && !empty($message)){  ?>
					<div class="alert alert-warning"><?php echo $message; ?></div>
				<?php } ?>

				<?php if(!empty($success)){  ?>
					<div class="alert alert-success"><?php echo $success; ?></div>
				<?php } ?>
				<?php if(!empty($danger)){  ?>
					<div class="alert alert-danger"><?php echo $danger; ?></div>
				<?php } ?>
				<section class="content-header">
		      <h1 class="h1"><?php echo $title; ?></h1>
		    </section>
		    <section class="content">
		    	<div class="row">
		    		<div class="col-lg-12"><div class="box"><div class="content">

							<?php $this->load->view($view_file); ?>
							<div class="clearfix"></div>
						</div></div></div>
				</div>
				</section>
			</div>

	</div>
	<?php $this->load->view('admin/layouts/footer'); ?>
</body>
</html>