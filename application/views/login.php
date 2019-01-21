<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h2 class="text-center">Masuk akun Pinjaman</h2>
    <?= $error ?>
    <form method="post">
      <div class="form-group">
        <label>Email</label>
        <input type="email" placeholder="Masukkan email" name="email" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" placeholder="Masukkan password" name="password" class="form-control" required="">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      <p>
        <a href="<?= base_url() ?>login/register">Belum punya akun daftar sekarang ?</a><br>
        <a href="<?= base_url() ?>login/forgot">Lupa password ?</a>
      </p>
    </form>
  </div>
</div>