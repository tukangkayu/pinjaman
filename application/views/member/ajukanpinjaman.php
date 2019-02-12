<div class="container">
	<div class="row">
	  <div class="col-md-12">
		<div class="row">
		    <h2 >Ajukan Pinjaman</h2>
			<form method="post" enctype='multipart/form-data'>
				<div class="form-group">
					<label>Judul Pengajuan</label>
					<input type="text" name="judul" pattern="[A-Za-z]{1,50}" required
        title="Just String" class="form-control" >
				</div>
				<div class="form-group">
					<label>Kategori Pinjaman</label>
					<div class="row">
						<div class="col-md-4">
							<input type="radio" value="0" name="jenis"> Pinjaman Personal
							<p class="help-block">Rp<span class="auto-numeric">1000000</span> s/d <span class="auto-numeric">2999999</span></p>
						</div>
						<div class="col-md-4">
							<input type="radio" value="1" name="jenis"> Pinjaman UKM kecil  
							<p class="help-block">Rp<span class="auto-numeric">3000000</span> s/d <span class="auto-numeric">49999999</span></p>
						</div>
						<div class="col-md-4">
							<input type="radio" value="2" name="jenis"> Pinjaman Perusahaan besar
							<p class="help-block">Rp<span class="auto-numeric">50000000</span> s/d <span class="auto-numeric">2000000000</span></p>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Jumlah Pinjaman</label>
					<input type="number" name="jumlah" id="jumlah-pinjaman" required="" min="1000000" max="2999999">
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label>Lama Pinjaman</label>
							<select name="lamapinjaman" id="" class="form-control" required="">
								<option value="1">1 Bulan</option>
								<option value="3">3 Bulan</option>
								<option value="6">6 Bulan</option>
								<option value="12">12 Bulan</option>
							</select>
						</div>
						<div class="col-md-4">
							<label>Bunga Efektif</label>
							<select name="bunga" id="" class="form-control" required="">
								<option value="15">15%</option>
								<option value="18">18%</option>
								<option value="21">21%</option>
								<option value="32">32%</option>
							</select>
						</div>
						<div class="col-md-4">
							<label>Pembayaran Pinjaman Pokok</label>
							<select name="carabayar" id="" class="form-control" required="">
								<option value="0">Per Bulan</option>
								<option value="1">Akhir Pinjaman</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>No NPWP</label>
							<input type="number"  name="npwp" class="form-control" required="">
						</div>
						<div class="col-md-6">
							<label>Scan NPWP</label>
							<input type="file" name="fotonpwp" class="form-control" required="">
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Ajukan</button>					
				</div>
			</form>
		</div>
	  </div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("input[type=radio][name=jenis]").on('change',function(){
			var value = $(this).val();
			if(value==0){
				$("#jumlah-pinjaman").attr('min',1000000);
		        $("#jumlah-pinjaman").attr('max',2999999);
			}else if(value==1){
				$("#jumlah-pinjaman").attr('min',3000000);
		        $("#jumlah-pinjaman").attr('max',49999999);
			}else if(value==2){
				$("#jumlah-pinjaman").attr('min',50000000);
		        $("#jumlah-pinjaman").attr('max',2000000000);
			}
		});
	});
</script>