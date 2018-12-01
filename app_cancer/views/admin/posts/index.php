<div class="clearfix"></div><br>
<table class="table table-striped">
	<tr>
		<th>Title</th>
		<th>Image</th>
		<th>Description</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	<?php if( $posts ){ ?>
		<?php foreach ($posts as $post){ ?>
			<tr>
        <td><?php echo htmlspecialchars($post->title,ENT_QUOTES,'UTF-8');?></td>
        <td width="70px"><img src="<?php echo base_url('assets/images/'.$post->featured_image); ?>" class='img-thumbnail'></td>
        <td><?php echo substr(strip_Tags($post->description), 0, 50).' ...'; ?></td>
        <td><?php echo $post->status?'Active':'Inactive'; ?></td>
				<td class="table_action">
					<?php echo anchor("admin/posts/edit/".$post->id, '<i class="fa fa-edit"></i>') ;?> &nbsp; &nbsp;  
					<?php echo anchor("admin/posts/delete/".$post->id, '<i class="fa fa-trash text-danger"></i>', 'onclick="return confirm(\'Record will delete permanent?\')"') ;?>
				</td>
			</tr>
		<?php } ?>
	<?php }else{ ?>
		<tr><td colspan="5" class="text-danger">No record Found</td></tr>
	<?php } ?>
</table>

<p><?php echo anchor('admin/posts/create', 'Create New Post', 'class="btn btn-warning"')?>