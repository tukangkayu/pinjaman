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
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
