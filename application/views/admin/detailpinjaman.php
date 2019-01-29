
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Detail Pinjaman</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Pinjaman</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Detail Pinjaman</h3>
        </div>
        <div class="box-body">
          <style type="text/css">
  .nav-tabs > li{
    left: 4%;
    margin-bottom: 15px;
  }
</style>
<?php
  $kategori = ["Personal","UKM Kecil","Perusahaan Besar"];
  $cara = ["Per Bulan","Akhir Pinjaman"];
  $disable = $pinjaman->kategori_pinjaman==0?"disabled":"";
  $readonly =$pinjaman->kategori_pinjaman==0?"readonly":"";
  $tab= $pinjaman->kategori_pinjaman==0?"":"data-toggle='tab'";
  $style=$pinjaman->kategori_pinjaman==0?" style='visibility:hidden'":"";
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <div class="row">
      <form method="post" enctype='multipart/form-data'>
        <ul class="nav nav-tabs text-left">
          <li class="active"><a data-toggle="tab" href="#profile">Info Profile</a></li>
          <li ><a data-toggle="tab" href="#step1">Info pengajuan</a></li>
          <li class="<?= $disable ?>"><a  <?= $tab ?> href="#step2">Identitas usaha</a></li>
          <li><a data-toggle="tab" href="#step3">Tujuan Pengalangan</a></li>
          <li><a data-toggle="tab" href="#step4">Data Keuangan</a></li>
          <li><a data-toggle="tab" href="#step5">Jaminan</a></li>
          <li><a data-toggle="tab" href="#step6">Dokumen Pendukung</a></li>
        </ul>

        <div class="tab-content">
          <div id="profile" class="tab-pane fade in active">
            <div class="row">
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Lengkap*</label>
                      <input type="text" name="nama" readonly="" class="form-control" value="<?= $member->nama_member ?>" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor KTP*</label>
                      <input type="text" name="noktp" readonly="" class="form-control" value="<?= $member->noktp ?>" required="">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tgl Lahir</label>
                      <input type="date" name="tgllahir" readonly=""  class="form-control" value="<?= $member->tgllahir ?>" required="">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Alamat Lengkap</label>
                      <input type="text" name="alamat" readonly="" class="form-control" value="<?= $member->alamat ?>" required="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <label for="">Provinsi*</label>
                    <input type="text" readonly="" value="<?= $member->provinsi ?>" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label for="">Kabupaten*</label>
                    <input type="text" readonly="" value="<?= $member->kabupaten ?>" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label>Kode Pos*</label>
                    <input type="text" name="kodepos" class="form-control" readonly="" value="<?= $member->kodepos ?>" required="">
                  </div>
                </div>
                  </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Handphone 1*</label>
                      <input type="text" name="hp1" class="form-control" readonly="" value="<?= $member->handphone1 ?>" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Handphone 2*</label>
                      <input type="text" name="hp2" class="form-control" readonly="" value="<?= $member->handphone2 ?>" required="">
                    </div>
                  </div>
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

                </div>
              </div>
            </div>
          </div>
          <div id="step1" class="tab-pane fade ">
            <div class="form-group">
              <label>Judul Pinjaman</label>
              <input type="text" readonly="" value="<?= $pinjaman->nama_pinjaman ?>" class="form-control">
            </div>
            <div class="form-group">
              <label>Kategori Pinjaman</label>
              <input type="text" readonly="" value="<?= $kategori[$pinjaman->kategori_pinjaman] ?>" class="form-control">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label>Jumlah Pinjaman</label>
                  <input type="text" readonly="" value="<?= $pinjaman->jumlah_pinjaman ?>" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Bunga Efektif</label>
                  <input type="text" readonly="" value="<?= $pinjaman->bunga_efektif ?>%" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label>Lama Pinjaman</label>
                  <input type="text" readonly="" value="<?= $pinjaman->lama_pinjaman ?> Bulan" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Cara Pembayaran</label>
                  <input type="text" readonly="" value="<?= $cara[$pinjaman->cara_pembayaran] ?>" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div id="step2" class="tab-pane fade">
            <div class="form-group">
              <div class="row">
              <div class="col-md-6">
                <label for="">Nama Resmi Usaha</label>
                <input type="text" name="namausaha" class="form-control" readonly="" value="<?= @$detailusaha->namausaha ?>">
              </div>
              <div class="col-md-6">
                <label for="">Jenis Usaha</label>
                <input type="text" value="<?= @$detailusaha->jenisusaha ?>" readonly="" class="form-control">
              </div>
            </div>
              </div>
              <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="">Tahun Pendirian</label>
                <input type="text" maxlength="4" name="tahun" class="form-control" readonly="" value="<?= @$detailusaha->tahunpendirian ?>">
              </div>
              <div class="col-md-6">
                <label for="">Kategori Usaha</label>
                <input type="text" value="<?= @$detailusaha->kategoriusaha ?>" readonly="" class="form-control">
              </div>
            </div>
              </div>
              <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat"  class="form-control" readonly=""><?= @$detailusaha->alamatusaha ?></textarea>
              </div>
              <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Provinsi</label>
                <input type="text" value="<?= @$detailusaha->provinsi ?>" class="form-control" readonly="">
              </div>
              <div class="col-md-4">
                <label for="">Kabupaten</label>
                <input type="text" value="<?= @$detailusaha->kabupaten ?>" class="form-control" readonly="">
              </div>
              <div class="col-md-4">
                <label>Kode Pos</label>
                <input type="text" name="kodepos" class="form-control" value="<?= @$detailusaha->kodepos ?>" readonly="">
              </div>
            </div>
              </div>
              <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="">No Telepon 1</label>
                <input type="text" name="telpon1" class="form-control" value="<?= @$detailusaha->telpon1 ?>" readonly="">
              </div>
              <div class="col-md-6">
                <label for="">No Telepon 2</label>
                <input type="text" name="telpon2" class="form-control" value="<?= @$detailusaha->telpon2 ?>" readonly="">
              </div>
            </div>
              </div>
              <div class="form-group">
              <label for="">Deskripsi Usaha</label>
              <textarea name="deskripsi"  class="form-control" readonly=""><?= @$detailusaha->deskripsi ?></textarea>
              </div>

              <div class="form-group">
                <label>Foto Usaha</label><br>
                <a href="<?= base_url() ?>uploads/pinjaman/<?= @$detailusaha->fotousaha ?>" class="btn btn-primary" download>Download</a>
              </div>
          </div>
          <div id="step3" class="tab-pane fade">
             <div class="form-group">
            <label for="">Deskripsi tujuan pengalanggan dana ini dilakukan</label>
            <textarea name="tujuandana"  class="form-control" readonly=""><?= $detail->tujuanpinjaman ?></textarea>
              </div>
          </div>
          <div id="step4" class="tab-pane fade">
             <div class="form-group">
          <label for="">Jumlah dan pendapatan laba bersih 1 tahun terakhir atau gaji perbulan bagi peminjam personal</label>
          <textarea name="pendapatan"  class="form-control" readonly=""><?= $detail->jumlahpendapatan ?></textarea>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="">Modal Usaha</label>
                  <textarea name="modalusaha"  class="form-control" readonly="" ><?= @$detailusaha->modalusaha ?></textarea>
                </div>
                <div class="col-md-6">
                  <label for="">Utang Usaha</label>
                  <textarea name="utangusaha"  class="form-control" readonly="" ><?= @$detailusaha->utangusaha ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div id="step5" class="tab-pane fade">
             <div class="form-group">
          <label for="">Deskripsi angunan dan jaminan yang akan diberikan beserta foto dari angunan dan jaminan jika tidak ada lewatkan</label>
          <textarea name="jaminan"  class="form-control" readonly=""><?= $detail->jaminan ?></textarea>
            </div>
            <div class="form-group">
              <label>File Jaminan</label><br>
              <a href="<?= base_url() ?>uploads/pinjaman/<?= $detail->filejaminan ?>" class="btn btn-primary" download="">Download</a>
            </div>
          </div>
          <div id="step6" class="tab-pane fade">
            <p class="help-block">
              Mohon Lengkapi dokumen dibawah ini.Kelengkapan dokumen ini menjadi penentu disetujuinya atau tidak.Format file pdf,xls,xlsx.Max 10 MB.Jika ada 2 atau lebih di zip.
            </p>
            <div class="form-group">
              <div class="row">

                <div class="col-md-4">
                  <label>Rekening Koran 3 bulan terakhir</label><br>
                  <a href="<?= base_url() ?>uploads/pinjaman/<?= $detail->filerekkoran3 ?>" class="btn btn-primary" download="">Download</a>
                </div>
                <div class="col-md-4" <?= $style ?>>
                  <label>Laporan Keuangan Tahunan</label><br>
                  <a href="<?= base_url() ?>uploads/pinjaman/<?= $detail->filelaporankeuangantahun ?>" class="btn btn-primary" download="">Download</a>
                </div>
                <div class="col-md-4" <?= $style ?>>
                  <label>SKU/SKDU/IUMK/SIUP</label><br>
                  <a href="<?= base_url() ?>uploads/pinjaman/<?= $detail->fileusaha ?>" class="btn btn-primary" download="">Download</a>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Dokumen Perjanjian Pinjaman</label><br>
              <a href="<?= base_url() ?>uploads/pinjaman/<?= $detail->filedokumenperjanjian ?>" class="btn btn-primary" download="">Download</a>
            </div>
          </div>
        </div>
        <div class="form-group">
              
              <div class="row">
                <?php
              if($pinjaman->status_pengajuan!=1){
              ?>
                <div class="col-md-5">
                   <button type="submit" name="approve" class="btn btn-primary btn-block">Approve</button>
                </div>
                <div class="col-md-5">
                  <button type="submit" name="reject" class="btn btn-danger btn-block">Reject</button>
                </div>
              <?php } ?>
              </div>
        </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-10">
                  <a href="<?= base_url() ?>admin/pinjaman" class="btn btn-warning btn-block">Back</a>                
                </div>
              </div>
            </div>
      </form>
    </div>
    </div>
  </div>
</div>
        </div>
        <!-- /.box-body -->
      </div>
      


    </section>
    <!-- /.content -->
  </div>