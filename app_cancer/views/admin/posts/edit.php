<div class="col-md-9">
  <?php echo form_open_multipart("admin/posts/edit/".$post->id);?>
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" value="<?php echo $post->title; ?>" class="form-control" placeholder="Post Name">
    </div>
    <div class="form-group">
      <label>Slug</label>
      <input type="text" name="slug" value="<?php echo $post->slug; ?>" class="form-control" placeholder="Post Slug">
    </div>
    <div class="form-group row">
      <div class="col-sm-8">
        <label>Image</label>
        <input type="file" name="featured_image" class="form-control">
      </div>
      <div class="col-sm-4"><img class="img-thumbnail" src="<?php echo base_url('assets/images/'.$post->featured_image); ?>" ></div>
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="textarea" placeholder="Post Description..." name="description">
        <?php echo $post->description; ?>
      </textarea>
      
    </div>
    <div class="form-group">
      <label>Status</label>
      <div class="row">
        <label class="col-xs-6 col-sm-4">
          <input name="status" type="radio" value="1" <?php echo $post->status==1?'checked="checked"':''; ?>> 
          Active
        </label>
        <label class="col-xs-6 col-sm-4">
          <input name="status" type="radio" value="0" <?php echo $post->status==0?'checked="checked"':''; ?>> 
          Inactive
        </label>
      </div>
    </div>
    <p><?php echo form_submit('submit', 'Update Post', 'class="btn btn-primary"');?></p>

  <?php echo form_close();?>
</div>
<div class="clearfix"></div>
<?php $this->render->footer .= wysihtml5_editor(); ?>