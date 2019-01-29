<div class="row">
  <div class="col-md-12">
    <div class="container">
      <h2 ><?= ucfirst($active) ?></h2>
      <ul class="nav nav-tabs">
        <li class="<?= $active=="profile"?"active":"" ?>"><a href="<?= base_url() ?>member/profile">Profile</a></li>
        <li class="<?= $active=="rekeningbank"?"active":"" ?>"><a href="<?= base_url() ?>member/rekeningbank">Rekening Bank</a></li>
        <li class="<?= $active=="profile"?"gantiemail":"" ?>"><a href="<?= base_url() ?>member/gantiemail">Ganti Email</a></li>
        <li class="<?= $active=="profile"?"gantipassword":"" ?>"><a href="<?= base_url() ?>member/gantipassword">Ganti Password</a></li>
      </ul>
      <form method="post" enctype='multipart/form-data'>
      <div class="row">
        <div class="col-md-10">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Lengkap*</label>
                <input type="text" name="nama" class="form-control" value="<?= $member->nama_member ?>" required="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Nomor KTP*</label>
                <input type="text" name="noktp" class="form-control" value="<?= $member->noktp ?>" required="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Tgl Lahir</label>
                <input type="date" name="tgllahir"  class="form-control" value="<?= $member->tgllahir ?>" required="" >
                <p class="text-danger"><?= @$msgtgllahir ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Foto KTP*</label>
                <input type="hidden" name="ktplama" value="<?= $member->fotoktp ?>">
                <input type="file" name="fotoktp" class="form-control" required="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Alamat Lengkap</label>
                <input type="text" name="alamat" class="form-control" value="<?= $member->alamat ?>" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label for="">Provinsi*</label>
              <select name="provinsi" class="form-control" required="">
                <option value="sumatera-utara">Sumatera Utara</option>
                <option value="jawa-barat">Jawa barat</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="">Kabupaten*</label>
              <select name="kabupaten" id="" class="form-control" required="">
                <option value="medan">Medan</option>
                <option value="deli-serdang">Deli Serdang</option>
                <option value="bandung">Bandung</option>
              </select>
            </div>
            <div class="col-md-4">
              <label>Kode Pos*</label>
              <input type="text" name="kodepos" class="form-control" value="<?= $member->kodepos ?>" required="">
            </div>
          </div>
            </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Handphone 1*</label>
                <input type="text" name="hp1" class="form-control" value="<?= $member->handphone1 ?>" required="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Handphone 2*</label>
                <input type="text" name="hp2" class="form-control" value="<?= $member->handphone2 ?>" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Foto Profile</label>
            <?php
            $lokasi = base_url()."uploads/";
            $default = $member->fotoprofil==''?"medium_nofoto.jpg":"profile/".$member->fotoprofil;
            ?>
            <p>
              <img src="<?= $lokasi.$default ?>" width="100%">          
            </p>
            <div class="form-group">
              <input type="hidden" name="profilelama" value="<?= $member->fotoprofil ?>">
              <input type="file" name="fotoprofile" id="foto-profile">
              <button type="button" id="btn-profile" class="btn btn-primary btn-block">Upload Foto</button>              
            </div>

          </div>
        <!--   <div class="form-group">
            <label>Lebih suka menjadi?</label>
            <input type="radio" value="0" name="prefer"> Investor <br>
            <input type="radio" value="1" name="prefer"> Peminjam

          </div> -->
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#foto-profile").hide();
    $("#btn-profile").click(function(){
      $("#foto-profile").click();
    })
  });
</script>