<div class="login-box-body">
    <h3 class="login-box-msg">Admin Login</h3>
    <div id="infoMessage"><?php echo $message;?></div>
    <?php echo form_open("admin/login");?>
      <div class="form-group has-feedback">
        <?php echo form_input($identity);?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo form_input($password);?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck col-xs-12">
            <label>
              <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
               Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <?php echo form_submit('submit', 'Login', 'class="btn btn-primary btn-block btn-flat"');?>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>