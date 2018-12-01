<div id="infoMessage"><?php echo $message;?></div>
<div class="col-md-8">
<?php echo form_open('admin/auth/edit_group/'.$group->id);?>

      <p>
            <?php echo lang('edit_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name);?>
      </p>

      <p>
            <?php echo lang('edit_group_desc_label', 'description');?> <br />
            <?php echo form_input($group_description);?>
      </p>

      <p><?php echo form_submit('submit', lang('edit_group_submit_btn'), 'class="btn btn-primary"');?></p>

<?php echo form_close();?>
</div>