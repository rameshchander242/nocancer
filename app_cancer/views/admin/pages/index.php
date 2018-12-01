<div class="clearfix"></div><br>
<table class="table table-striped">
	<tr>
		<th>Title</th>
		<th>Image</th>
		<th>Description</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	<?php if( $pages ){ ?>
		<?php foreach ($pages as $page){ ?>
			<tr>
        <td><?php echo htmlspecialchars($page->title,ENT_QUOTES,'UTF-8');?></td>
        <td width="70px"><img src="<?php echo base_url('assets/images/'.$page->featured_image); ?>" class='img-thumbnail'></td>
        <td><?php echo substr(strip_Tags($page->description), 0, 50).' ...'; ?></td>
        <td><?php echo $page->status?'Active':'Inactive'; ?></td>
				<td class="table_action">
					<?php echo anchor("admin/pages/edit/".$page->id, '<i class="fa fa-edit"></i>') ;?> &nbsp; &nbsp;  
					<?php echo anchor("admin/pages/delete/".$page->id, '<i class="fa fa-trash text-danger"></i>', 'onclick="return confirm(\'Record will delete permanent?\')"') ;?>
				</td>
			</tr>
		<?php } ?>
	<?php }else{ ?>
		<tr><td colspan="5" class="text-danger">No record Found</td></tr>
	<?php } ?>
</table>

<p><?php echo anchor('admin/pages/create', 'Create New Page', 'class="btn btn-warning"')?>