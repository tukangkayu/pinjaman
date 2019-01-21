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
		    <h2 >Pengajuan Pinjaman</h2>
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
			      	<input type="text" readonly="" value="<?= $pinjaman->nama_pinjaman ?>">
			      </div>
			      <div class="form-group">
			      	<label>Kategori Pinjaman</label>
			      	<input type="text" readonly="" value="<?= $kategori[$pinjaman->kategori_pinjaman] ?>">
			      </div>
			      <div class="form-group">
			      	<div class="row">
			      		<div class="col-md-6">
			      			<label>Jumlah Pinjaman</label>
			      			<input type="text" readonly="" value="<?= $pinjaman->jumlah_pinjaman ?>">
			      		</div>
			      		<div class="col-md-6">
			      			<label>Bunga Efektif</label>
			      			<input type="text" readonly="" value="<?= $pinjaman->bunga_efektif ?>%">
			      		</div>
			      	</div>
			      </div>
			      <div class="form-group">
			      	<div class="row">
			      		<div class="col-md-6">
			      			<label>Lama Pinjaman</label>
			      			<input type="text" readonly="" value="<?= $pinjaman->lama_pinjaman ?> Bulan">
			      		</div>
			      		<div class="col-md-6">
			      			<label>Cara Pembayaran</label>
			      			<input type="text" readonly="" value="<?= $cara[$pinjaman->cara_pembayaran] ?>">
			      		</div>
			      	</div>
			      </div>
			    </div>
			    <div id="step2" class="tab-pane fade">
			      <div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="">Nama Resmi Usaha</label>
							<input type="text" name="namausaha" class="form-control">
						</div>
						<div class="col-md-6">
							<label for="">Jenis Usaha</label>
							<select name="jenisusaha" id="" class="form-control">
								<option value="perseorangan">Perseorangan</option>
								<option value="cv">CV</option>
							</select>
						</div>
					</div>
			      </div>
			      <div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="">Tahun Pendirian</label>
							<input type="text" maxlength="4" name="tahun" class="form-control">
						</div>
						<div class="col-md-6">
							<label for="">Kategori Usaha</label>
							<select name="kategoriusaha" id="" class="form-control">
								<option value="advertising">Advertising</option>
								<option value="teknologi">Teknologi</option>
							</select>
						</div>
					</div>
			      </div>
			      <div class="form-group">
			      	<label>Alamat Lengkap</label>
			      	<textarea name="alamat"  class="form-control"></textarea>
			      </div>
			      <div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="">Provinsi</label>
							<select name="provinsi" class="form-control">
								<option value="sumatera-utara">Sumatera Utara</option>
								<option value="jawa-barat">Jawa barat</option>
							</select>
						</div>
						<div class="col-md-4">
							<label for="">Kabupaten</label>
							<select name="kabupaten" id="" class="form-control">
								<option value="medan">Medan</option>
								<option value="deli-serdang">Deli Serdang</option>
								<option value="bandung">Bandung</option>
							</select>
						</div>
						<div class="col-md-4">
							<label>Kode Pos</label>
							<input type="text" name="kodepos" class="form-control">
						</div>
					</div>
			      </div>
			      <div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="">No Telepon 1</label>
							<input type="text" name="telpon1" class="form-control">
						</div>
						<div class="col-md-6">
							<label for="">No Telepon 2</label>
							<input type="text" name="telpon2" class="form-control">
						</div>
					</div>
			      </div>
			      <div class="form-group">
						<label for="">Deskripsi Usaha</label>
						<textarea name="deskripsi"  class="form-control"></textarea>
			      </div>

			      <div class="form-group">
			      	<label>Foto Usaha</label>
			      	<input type="file" name="fotousaha" class="form-control">
			      </div>
			    </div>
			    <div id="step3" class="tab-pane fade">
			       <div class="form-group">
					<label for="">Deskripsi tujuan pengalanggan dana ini dilakukan</label>
					<textarea name="tujuandana"  class="form-control" required=""></textarea>
			      </div>
			    </div>
			    <div id="step4" class="tab-pane fade">
			       <div class="form-group">
					<label for="">Jumlah dan pendapatan laba bersih 1 tahun terakhir atau gaji perbulan bagi peminjam personal</label>
					<textarea name="pendapatan"  class="form-control" required=""></textarea>
			      </div>
			      <div class="form-group">
			      	<div class="row">
			      		<div class="col-md-6">
			      			<label for="">Modal Usaha</label>
			      			<textarea name="modalusaha"  class="form-control" <?= $readonly  ?>></textarea>
			      		</div>
			      		<div class="col-md-6">
			      			<label for="">Utang Usaha</label>
			      			<textarea name="utangusaha"  class="form-control" <?= $readonly  ?>></textarea>
			      		</div>
			      	</div>
			      </div>
			    </div>
			    <div id="step5" class="tab-pane fade">
			       <div class="form-group">
					<label for="">Deskripsi angunan dan jaminan yang akan diberikan beserta foto dari angunan dan jaminan jika tidak ada lewatkan</label>
					<textarea name="jaminan"  class="form-control"></textarea>
			      </div>
			      <div class="form-group">
			      	<label>File Jaminan</label>
			      	<input type="file" name="filejaminan" class="form-control">
			      	<p class="help-block">Jika file lebih dari satu file dalam bentuk zip</p>
			      </div>
			    </div>
			    <div id="step6" class="tab-pane fade">
			      <p class="help-block">
			      	Mohon Lengkapi dokumen dibawah ini.Kelengkapan dokumen ini menjadi penentu disetujuinya atau tidak.Format file pdf,xls,xlsx.Max 10 MB.Jika ada 2 atau lebih di zip.
			      </p>
			      <div class="form-group">
			      	<div class="row">

				      	<div class="col-md-4">
				      		<label>Rekening Koran 3 bulan terakhir</label>
				      		<input type="file" class="form-control" name="filekoran">
				      	</div>
			      		<div class="col-md-4" <?= $style ?>>
				      		<label>Laporan Keuangan Tahunan</label>
				      		<input type="file" class="form-control" name="filetahun">
				      	</div>
				      	<div class="col-md-4" <?= $style ?>>
				      		<label>SKU/SKDU/IUMK/SIUP</label>
				      		<input type="file" class="form-control" name="fileusaha">
				      	</div>
			      	</div>
			      </div>
			      <div class="form-group">
			      	<label>Dokumen Perjanjian Pinjaman</label>
			      	<input type="file" name="dokumenperjanjian" class="form-control" required="">
			      </div>
			    </div>
			  </div>
			  <div class="form-group">
			  	<button class="btn btn-primary">Kirim</button>
			  	<a href="<?= base_url() ?>pinjaman/listpinjaman" class="btn btn-warning">Kembali</a>
			  </div>
			</form>
		</div>
	  </div>
	</div>
</div>