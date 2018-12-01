<div class="col-md-9">
  <?php echo form_open_multipart("admin/foods/edit/".$food->id);?>
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" value="<?php echo $food->title; ?>" class="form-control" placeholder="Food Name">
    </div>
    <div class="form-group">
      <label>Slug</label>
      <input type="text" name="slug" value="<?php echo $food->slug; ?>" class="form-control" placeholder="Food Slug">
    </div>
    <div class="form-group row">
      <div class="col-sm-8">
        <label>Image</label>
        <input type="file" name="food_image" class="form-control">
      </div>
      <div class="col-sm-4"><img class="img-thumbnail" src="<?php echo base_url('assets/images/'.$food->food_image); ?>" ></div>
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea name="description" class="form-control textarea" placeholder="Food Description..."><?php echo $food->description; ?></textarea>
    </div>
    <div class="form-group">
      <label>Rating</label>
      <div class="row">
        <?php 
        $food_rating = json_decode($food->rating);
        foreach(json_decode($this->config->config['nocancer']['rating']) as $key=>$rating){ 
          $rating_checked = is_array($food_rating) && in_array(getSlug($rating), $food_rating)?'checked="checked"':'';
        ?>
          <div class="form-group moderan-checkbox col-sm-6">
            <input type="checkbox" name="rating[]" <?php echo $rating_checked; ?> id="<?php echo $rating; ?>" value="<?php echo getSlug($rating); ?>" />
            <div class="btn-group">
                <label for="<?php echo $rating; ?>" class="btn btn-<?php echo $key; ?>">
                    <span class="[ glyphicon glyphicon-ok ]"></span>
                    <span> </span>
                </label>
                <label for="<?php echo $rating; ?>" class="btn btn-<?php echo $key; ?> active title">
                    <?php echo getTitle($rating); ?>
                </label>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="form-group">
      <label>Information Sources</label>
      <div class="information_sources">
        <?php foreach( json_decode($food->information_sources) as $information_source ){ ?>
        <div class="input-group">
          <input type="text" name="information_sources[]" value="<?php echo $information_source; ?>" class="form-control">
          <span class="input-group-addon" onclick="removeParent(this)"><i class="fa fa-close"></i></span>
        </div>
        <?php } ?>
      </div>
      <input type="button" value="Add more.." class="btn btn-warning pull-right" onclick="addMoreInput('information_sources')">
      <br>
    </div>
    <div class="form-group">
      <label>Recomend Products</label>
      <div class="recomend_products">
        <?php foreach( json_decode($food->recomend_products) as $recomend_product ){ ?>
        <div class="input-group">
          <input type="text" name="recomend_products[]" value="<?php echo $recomend_product; ?>" class="form-control">
          <span class="input-group-addon" onclick="removeParent(this)"><i class="fa fa-close"></i></span>
        </div>
        <?php } ?>
      </div>
      <input type="button" value="Add more.." class="btn btn-warning pull-right" onclick="addMoreInput('recomend_products')">
      <br>
    </div>
    <div class="form-group">
      <label>Additional Information</label>
      <input type="text" name="additional_information" value="<?php echo $food->additional_information; ?>" class="form-control" placeholder="Food Name">
    </div>

    <p><?php echo form_submit('submit', 'Update Food', 'class="btn btn-primary"');?></p>

  <?php echo form_close();?>
</div>
<div class="clearfix"></div>

<script>
function removeParent(_this){
  $(_this).parent('div').remove();
}
function addMoreInput(classname){
  $('.'+classname).append('<div class="input-group"><input type="text" name="'+classname+'[]" value="" class="form-control"><span class="input-group-addon" onclick="removeParent(this)"><i class="fa fa-close"></i></span></div');
}
</script>
<?php $this->render->footer .= wysihtml5_editor(); ?>