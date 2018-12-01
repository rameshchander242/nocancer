<div class="col-md-9">
  <?php echo form_open_multipart("admin/pages/edit/".$page->id);?>
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" value="<?php echo $page->title; ?>" class="form-control" placeholder="Page Name">
    </div>
    <div class="form-group">
      <label>Slug</label>
      <input type="text" name="slug" value="<?php echo $page->slug; ?>" class="form-control" placeholder="Page Slug">
    </div>
    <div class="form-group row">
      <div class="col-sm-8">
        <label>Image</label>
        <input type="file" name="featured_image" class="form-control">
      </div>
      <div class="col-sm-4"><img class="img-thumbnail" src="<?php echo base_url('assets/images/'.$page->featured_image); ?>" ></div>
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="textarea" placeholder="Page Description..." name="description">
        <?php echo $page->description; ?>
      </textarea>
      
    </div>
    <div class="form-group">
      <label>Status</label>
      <div class="row">
        <label class="col-xs-6 col-sm-4">
          <input name="status" type="radio" value="1" <?php echo $page->status==1?'checked="checked"':''; ?>> 
          Active
        </label>
        <label class="col-xs-6 col-sm-4">
          <input name="status" type="radio" value="0" <?php echo $page->status==0?'checked="checked"':''; ?>> 
          Inactive
        </label>
      </div>
    </div>
    <p><?php echo form_submit('submit', 'Update Page', 'class="btn btn-primary"');?></p>

  <?php echo form_close();?>
</div>
<div class="clearfix"></div>
<?php $this->render->footer .= wysihtml5_editor(); ?>