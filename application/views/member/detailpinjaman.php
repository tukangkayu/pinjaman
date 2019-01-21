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
          <li class="active"><a data-toggle="tab" href="#step1">Info pengajuan</a></li>
          <li class="<?= $disable ?>"><a  <?= $tab ?> href="#step2">Identitas usaha</a></li>
          <li><a data-toggle="tab" href="#step3">Tujuan Pengalangan</a></li>
          <li><a data-toggle="tab" href="#step4">Data Keuangan</a></li>
          <li><a data-toggle="tab" href="#step5">Jaminan</a></li>
          <li><a data-toggle="tab" href="#step6">Dokumen Pendukung</a></li>
        </ul>

        <div class="tab-content">
          <div id="step1" class="tab-pane fade in active">
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
                  <textarea name="utangusaha"  class="form-control" readonly="" ><?= @$detailusaha->modalusaha ?></textarea>
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
              <a href="<?= base_url() ?>pinjaman/<?= $detail->filejaminan ?>" class="btn btn-primary" download="">Download</a>
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
                  <a href="<?= base_url() ?>pinjaman/<?= $detail->filerekkoran3 ?>" class="btn btn-primary" download="">Download</a>
                </div>
                <div class="col-md-4" <?= $style ?>>
                  <label>Laporan Keuangan Tahunan</label><br>
                  <a href="<?= base_url() ?>pinjaman/<?= $detail->filelaporankeuangantahun ?>" class="btn btn-primary" download="">Download</a>
                </div>
                <div class="col-md-4" <?= $style ?>>
                  <label>SKU/SKDU/IUMK/SIUP</label><br>
                  <a href="<?= base_url() ?>pinjaman/<?= $detail->fileusaha ?>" class="btn btn-primary" download="">Download</a>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Dokumen Perjanjian Pinjaman</label><br>
              <a href="<?= base_url() ?>pinjaman/<?= $detail->filedokumenperjanjian ?>" class="btn btn-primary" download="">Download</a>
            </div>
          </div>
        </div>
        <div class="form-group">
          <a href="<?= base_url() ?>pinjaman/listpinjaman" class="btn btn-warning">Kembali</a>
        </div>
      </form>
    </div>
    </div>
  </div>
</div>