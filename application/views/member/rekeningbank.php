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
      <form method="post"  enctype='multipart/form-data'>
      <div class="row">
        <div class="col-md-10">          
          <div class="form-group">
            <label for="">Nama Bank*</label>
            <input type="text" name="namabank" pattern="[A-Za-z]{1,50}" required
        title="Just String" class="form-control" value="<?= $member->namabank ?>" >
          </div>
          <div class="form-group">
            <label for="">No Rekening*</label>
            <input type="number" pattern="[0-9]" title="Just Number" name="norekening" class="form-control" value="<?= $member->norekening ?>" required>
          </div>
          <div class="form-group">
            <label for="">Nama di rekening*</label>
            <input type="text" name="namarekening" pattern="[A-Za-z]{1,50}" required
        title="Just String" class="form-control"  value="<?= $member->namarekening ?>">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Foto Buku Tabungan</label>
            <?php
            $lokasi = base_url()."uploads/";
            $default = $member->fotobukutabungan==''?"medium_nofoto.jpg":"tabungan/".$member->fotobukutabungan;
            ?>
            <p>
              <img src="<?= $lokasi.$default ?>" width="100%">          
            </p>
            <div class="form-group">
              <input type="hidden" name="tabunganlama" value="<?= $member->fotobukutabungan ?>">
              <input type="file" name="fotobukutabungan" id="foto-buku">
              <button type="button" id="btn-buku" class="btn btn-primary btn-block">Upload Foto</button>              
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#foto-buku").hide();
    $("#btn-buku").click(function(){
      $("#foto-buku").click();
    })
  });
</script>