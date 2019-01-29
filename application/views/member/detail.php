<?php
$day=strtotime(Date("Y-m-d"))-(strtotime($pinjaman->updated_at));
$day = $day / (60 * 60 * 24);
$day= (int)$day;
$enddays = strtotime('+30 days', strtotime($pinjaman->updated_at));
$enddays = strtotime('-'.($day).' days', $enddays);
$end = $enddays - strtotime($pinjaman->updated_at);
$text = $end<=0?"Berakhir":($end / (60 * 60 * 24))." hari lagi";
$kategori = ["Personal","UKM Kecil","Perusahaan Besar"];
$cara = ["Per Bulan","Akhir Pinjaman"];
$lender = $this->mdana->ambilPemindahan(['id_pinjaman'=>$pinjaman->id,'status'=>1]);
$total = 0;
foreach($lender as $t){
	$total += $t->jumlah;
}
$percent = ($pinjaman->jumlah_pinjaman-$total)/$pinjaman->jumlah_pinjaman*100;
$percent = 100-$percent;
$text = $percent==100?"Berakhir":$text;
?>
<div class="container">
	<div class="row">
	  <div class="col-md-12">
	    <h2 ><?= $pinjaman->nama_pinjaman ?></h2>
		<div class="row">
			<div class="col-md-9">
				<span class="label label-<?= $pinjaman->status_pinjaman==0?'success':'primary' ?>"><?= $text ?></span>
                <span class="label label-primary"><?= $kategori[$pinjaman->kategori_pinjaman] ?></span>
                <p>Telah terkumpul <?= $percent ?>% dari <?= count($lender) ?> Lenders</p>
                <div class="donation-progress progress row">
	                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $percent ?>%"
	                     aria-valuemin="0" aria-valuemax="100" style="width: <?= $percent ?>%"
	                     title="<?= $percent ?> %">
	                </div>
	            </div>
				<div class="row">
					<div class="col-md-4">
						<span class="text-muted">Jumlah Pinjaman</span><br>
                        <b class="raised auto-numeric" data-a-sep="." data-a-dec="," data-a-sign="Rp."><?= $pinjaman->jumlah_pinjaman ?></b>
					</div>
					<div class="col-md-4">
						<span class="text-muted">Tenor</span><br>
                        <b><?= $pinjaman->lama_pinjaman ?> Bulan</b>
					</div>
					<div class="col-md-4">
						<span class="text-muted">Bunga Efektif</span><br>
	                    <b><?= $pinjaman->bunga_efektif ?>%</b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<span class="text-muted">Agunan</span><br>
                        <b><?= $detail->jaminan!=''?"Ada":"Tidak Ada" ?></b>
					</div>
					<div class="col-md-4">
						<span class="text-muted">Frek angsuran pokok</span><br>
                        <b><?= $cara[$pinjaman->cara_pembayaran] ?></b>
					</div>
					<div class="col-md-4">
						<span class="text-muted">Frek angsuran bunga</span><br>
                        <b>Bulanan</b>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<img src="<?= base_url() ?>uploads/pinjaman/<?= @$detailusaha->fotousaha ?>'" style="max-height: 200px;width: 100%">
			</div>
		</div>
		<hr>
		<?php
		if(isset($_SESSION['id_member'])){
		?>
		<div class="jumbotron" style="min-height: 400px;">
			<ul class="nav nav-tabs text-left">
	          <li class="active"><a data-toggle="tab" href="#step1">Detail Kampanya</a></li>
	          <li><a data-toggle="tab" href="#step2">Informasi Usaha</a></li>
	          <li><a data-toggle="tab" href="#step3">History</a></li>
	          <li><a data-toggle="tab" href="#step4">Review & Rating</a></li>
	        </ul>
	        <div class="tab-content col-md-6">
	         <div id="step1" class="tab-pane fade in active">
					<div class="row">
						<div class="col-md-6">
							<span class="text-muted">Mulai Pengalangan Dana</span><br>
			                <b><?= Date("d/m/Y",strtotime($pinjaman->updated_at)) ?></b>
						</div>
						<div class="col-md-6">
							<span class="text-muted">Akhir Pengalangan Dana</span><br>
			                <b><?= Date("d/m/Y",$enddays) ?></b>
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-md-12">
							<span>Tujuan Pengalangan Dana</span><br>
							<b><?= $detail->tujuanpinjaman ?></b>
						</div>
					</div> -->
					<div class="row">
						<div class="col-md-12">
							<span>Jaminan dan Agunan</span><br>
							<b><?= $detail->jaminan==''?'Tidak ada':$detail->jaminan ?></b>
						</div>
					</div>
	          </div>
	          <div id="step2" class="tab-pane fade">
	          	<div class="row">
					<div class="col-md-6">
						<span class="text-muted">Jenis Usaha</span><br>
		                <b><?= @$detailusaha->jenisusaha ?></b>
					</div>
					<div class="col-md-6">
						<span class="text-muted">Kategori Usaha</span><br>
		                <b><?= @$detailusaha->kategoriusaha  ?></b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<span class="text-muted">Tahun pendirian</span><br>
		                <b><?= @$detailusaha->tahunpendirian ?></b>
					</div>
					<div class="col-md-6">
						<span class="text-muted">Domisili Usaha</span><br>
		                <b><?= @$detailusaha->alamatusaha  ?></b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<span class="text-muted">Deskripsi usaha</span><br>
		                <b><?= @$detailusaha->deskripsi ?></b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<span class="text-muted">Jumlah Pendapatan</span><br>
		                <b><?= @$detail->jumlahpendapatan ?></b>
					</div>
					<div class="col-md-4">
						<span class="text-muted">Modal Usaha</span><br>
		                <b><?= @$detailusaha->modalusaha ?></b>
					</div>
					<div class="col-md-4">
						<span class="text-muted">Utang Usaha</span><br>
		                <b><?= @$detailusaha->utangusaha ?></b>
					</div>
				</div>
	          </div>
	          <div id="step3" class="tab-pane fade">
	          	<h3>INFORMASI RIWAYAT PINJAMAN</h3>
	          	<div class="row">
	          		<div class="col-md-6">
	          			Pinjaman dalam penawaran
	          		</div>
	          		<div class="col-md-1">
	          			<?= count($penawaran) ?>
	          		</div>
	          		<div class="col-md-5">
	          			<span class="auto-numeric"><?= $totalpenawaran ?></span> 
	          		</div>
	          	</div>
	          	<div class="row">
	          		<div class="col-md-6">
	          			Pinjaman aktif
	          		</div>
	          		<div class="col-md-1">
	          			<?= count($aktif) ?>
	          		</div>
	          		<div class="col-md-5">
	          			<span class="auto-numeric"><?= $totalaktif ?></span> 
	          		</div>
	          	</div>
	          	<div class="row">
	          		<div class="col-md-6">
	          			Pinjaman lunas
	          		</div>
	          		<div class="col-md-1">
	          			<?= count($lunas) ?>
	          		</div>
	          		<div class="col-md-5">
	          			<span class="auto-numeric"><?= $totallunas ?></span> 
	          		</div>
	          	</div>
	          </div>
	          <div id="step4" class="tab-pane fade">
	          	<p>Average rating : <?= count($rating)==0?0:$totalrating/count($rating) ?></p>
	          	<div class="row" style="max-height: 300px;">
          			<?php
          			foreach($rating as $r){
          				$member = $this->Mmember->ambilSemuaMember(['id_member'=>$r->id_member])[0]; 
          			?>
          			<div class="col-md-3">
          				<img src="<?= base_url() ?>uploads/profile/<?= $member->fotoprofil ?>" width="100%">
          			</div>
          			<input id="post" value='<?= $r->rating ?>' class="rating-loading ratingbar" data-min="0" data-max="5" data-step="1">
          			<span><?= $r->isi ?></span>
          			<?php
          			}
          			?>
	          	</div>
	          	<?php
	          	// if($pinjam->status_pinjaman==1){	  
	          	$userrating = $this->mrating->ambilRating(['id_member'=>$_SESSION['id_member'],'id_pinjaman'=>$pinjaman->id]);
	          	// print_r($pinjaman);
	          	if(count($userrating)==0 && $pinjaman->status_pinjaman==1 && $pinjaman->start_at!="0000-00-00"){		
	          	?>
	          	<form method="post" action="<?= base_url() ?>member/berirating/<?= $pinjaman->id ?>">
		          	<div class="form-group">
		          		<label>Berikan Rating</label>
		          		<input id="post" name="rating"  class="rating-loading ratingbar2" data-min="0" data-max="5" data-step="1">
		          		<textarea name="review" class="form-control" placeholder="Masukkan review"></textarea>
		          		<button type="submit" name="kirimrating" class="btn btn-primary">Kirim</button>
		          	</div>
	          	</form>
	          	<?php
	          }
	          	 // } 
	          	 ?>
	          </div>
			</div>
			<?php 
			$day=strtotime(Date("Y-m-d"))-(strtotime($pinjaman->updated_at));
        	$day = $day / (60 * 60 * 24);
        	$day= (int)$day;
        	$enddays = strtotime('+1 month', strtotime($pinjaman->updated_at));
            $enddays = strtotime('-'.($day).' days', $enddays);
            $end = $enddays - strtotime($pinjaman->updated_at);
            // $text = $end<=0?"Berakhir":($end / (60 * 60 * 24))." hari lagi";
			if(($pinjaman->jumlah_pinjaman - $total)>0 && $end>0){
				$max = $pinjaman->jumlah_pinjaman - $total;
				$max = $member->saldo < $max?$member->saldo:$max;
			?>
			<div class="col-md-6">
				<p>Total Pinjaman yang masih dibutuhkan <span class="auto-numeric"><?= ($pinjaman->jumlah_pinjaman - $total)  ?></span></p>
				<form method="post">
					<div class="form-group">
						<label>Masukkan uang yang akan dipinjamkan</label>
						<div class="row">
							<div class="col-md-9">
								<input type="number" name="jumlahuang" id="hitung" min="100000" max="<?= $max  ?>" class="form-control" required="">								
								<p class="help-block" id="jumlahdapat"></p>
							</div>
							<div class="col-md-3">
								<a id="btnhitung" 
								" class="btn btn-primary">Hitung</a>
							</div>
							<div class="col-md-12">
							<button type="submit" class="btn btn-primary">Berikan Pinjaman</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<?php } ?>

	  </div>
	  <?php }else{ ?>
	  <div class="jumbotron">
	  	<p>Untuk melihat lebih detail anda wajib login dulu</p>
	  </div>
	  <?php } ?>
	</div>	
</div>
</div>
<br>
<!-- Modal -->
<div class="modal fade" id="modal-cara-pengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Cara Beri Pinjaman</h4>
          </div>
      
          <div class="modal-body">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          
          <div class="modal-footer">
              <button type="button"  class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>
<!-- Modal -->
<script type="text/javascript">
$(document).ready(function(){

      // Initialize
      $('.ratingbar').rating({
        showCaption:false,
        showClear: false,
        size: 'sm',
        disabled:true
      });
      $('.ratingbar2').rating({
        showCaption:false,
        showClear: false,
        size: 'sm'
      });
      var bunga =  "<?= $pinjaman->bunga_efektif ?>";
      var tenor = "<?= $pinjaman->lama_pinjaman ?>";
      $("#btnhitung").click(function(){
      	var hitung = $("#hitung").val();
      	var bungaasli = parseInt(bunga)/12*parseInt(tenor)/100;
      	var bungauang =  bungaasli*hitung;
      	$("#jumlahdapat").html("<small>Total "+(parseInt(bungauang)+parseInt(hitung))+" yang akan didapatkan</small>");
      });
      // Rating change
      // $('.ratingbar').on('rating:change', function(event, value, caption) {
      //   var id = this.id;
      //   var splitid = id.split('_');
      //   var postid = splitid[1];

        // $.ajax({
        //   url: '<?= base_url() ?>',
        //   type: 'post',
        //   data: {postid: postid, rating: value},
        //   success: function(response){
        //      $('#averagerating_'+postid).text(response);
        //   }
        // });
      // });
    });
 
    </script>
