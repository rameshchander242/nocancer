<div class="col-md-12 row">
	<form>	
		<div class="col-xs-6 p-0">
			<input type="text" name="search" value="<?php echo isset($_GET['search'])?$_GET['search']:''; ?>" 
				placeholder="Search Food..." class="form-control">
		</div>
		<div class="col-xs-3">
			<select name="rating" class="form-control">
				<option value="">Select Label</option>
				<?php foreach(json_decode($this->config->config['nocancer']['rating']) as $rating){ ?>
					<option value="<?php echo getSlug($rating); ?>" <?php echo (isset($_GET['rating']) && $_GET['rating']==getSlug($rating))?'selected="selected"':''; ?>><?php echo getTitle($rating); ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-xs-3 p-0">
			<input type="submit" value="Search Now" class='btn btn-warning'>
			<input type="button" value="Clear" class='btn btn-default' onclick="window.location='<?php echo base_url('admin/foods'); ?>'">
		</div>
	</form>
</div>
<div class="clearfix"></div><br>
<table class="table table-striped" cellpadding=0 cellspacing=10>
	<tr>
		<th>Title</th>
		<th>Image</th>
		<th>Description</th>
		<th class="text-center">Featured</th>
		<th>Action</th>
	</tr>
	<?php if( $foods ){ ?>
		<?php foreach ($foods as $food){ ?>
			<tr>
        <td><?php echo htmlspecialchars($food->title,ENT_QUOTES,'UTF-8');?></td>
        <td width="70px"><img src="<?php echo base_url('assets/images/'.$food->food_image); ?>" class='img-thumbnail'></td>
        <td><?php echo substr(strip_Tags($food->description), 0, 50).' ...'; ?></td>
        <td class="text-center table_action">
        	<?php echo anchor("admin/foods/featured/".$food->id, '<i class="fa fa-star'.($food->featured?'':'-o').'"></i>', 
        		'class="text-warning" onclick="return confirm(\'Are You Sure?\')"') ;?>
       	</td>
				<td class="table_action">
					<?php echo anchor("admin/foods/edit/".$food->id, '<i class="fa fa-edit"></i>') ;?> &nbsp; &nbsp;  
					<?php echo anchor("admin/foods/delete/".$food->id, '<i class="fa fa-trash text-danger"></i>', 'onclick="return confirm(\'Record will delete permanent?\')"') ;?>
				</td>
			</tr>
		<?php } ?>
	<?php }else{ ?>
		<tr><td colspan="5" class="text-danger">No record Found</td></tr>
	<?php } ?>
</table>
<?php echo $paginate; ?>
<p><?php echo anchor('admin/foods/create', 'Create New Food', 'class="btn btn-warning"')?>