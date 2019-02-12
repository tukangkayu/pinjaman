<div class="row">
  <div class="col-md-12">
    <div class="container">
      <h2 ><?= ucfirst($active) ?></h2>
      <ul class="nav nav-tabs">
        <li class="<?= $active=="profile"?"active":"" ?>"><a href="<?= base_url() ?>member/profile">Profile</a></li>
        <li class="<?= $active=="rekeningbank"?"active":"" ?>"><a href="<?= base_url() ?>member/rekeningbank">Rekening Bank</a></li>
        <li class="<?= $active=="gantiemail"?"active":"" ?>"><a href="<?= base_url() ?>member/gantiemail">Ganti Email</a></li>
        <li class="<?= $active=="gantipassword"?"active":"" ?>"><a href="<?= base_url() ?>member/gantipassword">Ganti Password</a></li>
      </ul>
      <form method="post">
      <div class="row">
        <div class="col-md-12">          
          <div class="form-group">
            <label for="">Email Lama*</label>
            <input type="email" name="emaillama" class="form-control" value="<?= $member->email_member ?>" required="">
          </div>
          <div class="form-group">
            <label for="">Email Baru*</label>
            <input type="email" required="" name="emailbaru" class="form-control">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>