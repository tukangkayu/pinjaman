<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h2 class="text-center">Daftar akun Pinjaman</h2>
  <?php
  if(isset($_COOKIE['pesan_register'])):
  ?>
  <div class="alert alert-info" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <?= $_COOKIE['pesan_register']; ?>
  </div>
  <?php unset($_COOKIE['pesan_register']);setcookie('pesan_register','',time()-3600,'/'); endif;?>
    <form method="post">
      <div class="form-group">
        <label>Email</label>
        <input type="email" placeholder="Masukkan email" name="email" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" id="password" placeholder="Masukkan password" name="password" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Re-Password</label>
        <input type="password" id="repassword"  placeholder="Masukkan password" name="password" class="form-control" required="">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
      <p>
        <a href="<?= base_url() ?>login">Sudah punya akun?Silahkan login</a><br>
      </p>
    </form>
  </div>
</div>
<script type="text/javascript">
    var pass=document.getElementById("password");
    var repass=document.getElementById("repassword");
    function validate(){
        if(pass.value != repass.value){
            repass.setCustomValidity("Password not match");
        }else{
            repass.setCustomValidity("");
        }
    }
    pass.onchange=validate;
    repass.onkeyup=validate;
</script>