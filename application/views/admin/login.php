<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Admin Login</p>
    <?= $error ?>
    <form method="post">
      <div class="form-group has-feedback">
        <label>Email Admin</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="">
      </div>
      <div class="form-group has-feedback">
        <label>Password Admin</label>
        <input type="password" name="password" id="password"  class="form-control" placeholder="Password" required="">
      </div>
      <div class="row">
        <div class="col-xs-12  form-group">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <div class="col-xs-12">
          <a href="<?= base_url() ?>" class="btn btn-default btn-block btn-flat">Back To Home</a>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
