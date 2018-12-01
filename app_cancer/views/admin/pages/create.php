<div class="col-md-9">
  <?php echo form_open_multipart("admin/pages/create");?>
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" value="" class="form-control" placeholder="Page Name">
    </div>
    <div class="form-group">
      <label>Image</label>
      <input type="file" name="featured_image" class="form-control">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="textarea" placeholder="Page Description..." name="description"></textarea>
    </div>
    <div class="form-group">
      <label>Status</label>
      <div class="row">
        <label class="col-xs-6 col-sm-4">
          <input name="status" type="radio" value="1" checked="checked"> 
          Active
        </label>
        <label class="col-xs-6 col-sm-4">
          <input name="status" type="radio" value="0"> 
          Inactive
        </label>
      </div>
    </div>
    <p><?php echo form_submit('submit', 'Create Page', 'class="btn btn-primary"');?></p>

  <?php echo form_close();?>
</div>
<div class="clearfix"></div>
<?php $this->render->footer .= wysihtml5_editor(); ?>