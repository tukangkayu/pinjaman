<div class="container">
	<div class="row">
	  <div class="col-md-12">
	    <h2 >Beri Pinjaman</h2>
		<div class="row">
			<div class="col-md-9">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<a class="btn btn-primary"  data-toggle="modal" data-target="#modal-cara-pengajuan">Cara Beri Pinjaman</a>
			</div>
			<div class="col-md-3">
				<img src="<?= base_url() ?>uploads/noimage.png" style="max-height: 200px;width: 100%">
			</div>
		</div>
		<hr>
		<div class="jumbotron" style="background: #F6FBFF;">
		    <div class="container">
		        <div class="row patient-row">
		            <div class="col-sm-12">

		            <h2 class="section-title" >Kampanye Pinjaman Yang Sedang Berlangsung</h2>
		            <div class="row">
		            <?php
		            foreach($pinjaman as $p){
		            	$day=strtotime(Date("Y-m-d"))-(strtotime($p->updated_at));
		            	$day = $day / (60 * 60 * 24);
		            	$day= (int)$day;
		                // $enddays = strtotime('+'.(30-$day).' days', strtotime($p->updated_at));
		                // $enddays = strtotime('+1 month', strtotime($p->updated_at));
		                // $enddays = strtotime('-'.($day).' days', $enddays);
		                // $end = $enddays - strtotime($p->updated_at);
		                // $text = $end<=0?"Berakhir":($end / (60 * 60 * 24))." hari lagi";
                        $enddays = strtotime('+30 days', strtotime($pinjaman->updated_at));
		                $end = $enddays - strtotime($pinjaman->updated_at);
		                $text = $enddays<=0?"Berakhir":($end / (60 * 60 * 24))." hari lagi";
		                $detail = $this->mpinjaman->detailPinjaman(['id_pinjaman'=>$p->id])[0];
		                @$detailusaha = $this->mpinjaman->detailUsaha(['id_pinjaman'=>$p->id])[0];
		                $kategori = ["Personal","UKM Kecil","Perusahaan Besar"];
		                $cara = ["Per Bulan","Akhir Pinjaman"];
		                $lender = $this->mdana->ambilPemindahan(['id_pinjaman'=>$p->id,'status'=>1]);
		                $total = 0;
		                foreach($lender as $t){
		                    $total += $t->jumlah;
		                }
		                $percent = ($p->jumlah_pinjaman-$total)/$p->jumlah_pinjaman*100;
		                $percent = 100-$percent;
		                $text = $percent==100?"Berakhir":$text;
		            ?><a href="<?= base_url() ?>pinjaman/detail/<?= $p->id ?>">
		                <div class="patient-card col-md-4 col-sm-6">
		                        <div class="panel col-md-12">
		                            <div style="position:relative;">
		                                <div class="row patient-img" style="background: url('<?= base_url() ?>uploads/pinjaman/<?= @$detailusaha->fotousaha ?>')"></div>
		                                <span class="label label-<?= $p->status_pinjaman!=2?'success':'primary' ?>"><?= $text ?></span>
		                                <span class="label label-primary"><?= $kategori[$p->kategori_pinjaman] ?></span>
		                            </div>
		                            <div class="patient-summary">
		                                <h4 class="patient-headline">
		                                    <a href="#" class="link" style="color:#5D5D5D"><?= $p->nama_pinjaman ?></a>
		                                </h4>
		                                    Telah terkumpul <?= $percent ?>% dari <?= count($lender) ?> Lenders
		                            </div>
		                            <div class="donation-progress progress row">
		                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $percent ?>%"
		                                     aria-valuemin="0" aria-valuemax="100" style="width: <?= $percent ?>%"
		                                     title="<?= $percent ?> %">
		                                </div>
		                            </div>
		                            <div class="row">
		                                <div class="col-md-6">
		                                    <span class="text-muted">Jumlah Pinjaman</span><br>
		                                    <b class="raised auto-numeric" data-a-sep="." data-a-dec="," data-a-sign="Rp."><?= $p->jumlah_pinjaman ?></b>
		                                </div>
		                                <div class="col-md-6">
		                                    <span class="text-muted">Tenor</span><br>
		                                    <b><?= $p->lama_pinjaman ?> Bulan</b>
		                                </div>
		                                <div class="col-md-6">
		                                    <span class="text-muted">Bunga Efektif</span><br>
		                                    <b><?= $p->bunga_efektif ?>%</b>
		                                </div>
		                                <div class="col-md-6">
		                                    <span class="text-muted">Agunan</span><br>
		                                    <b><?= $detail->jaminan!=''?"Ada":"Tidak Ada" ?></b>
		                                </div>
		                                <div class="col-md-6">
		                                    <span class="text-muted">Frek angsuran pokok</span><br>
		                                    <b><?= $cara[$p->cara_pembayaran] ?></b>
		                                </div>
		                                <div class="col-md-6">
		                                    <span class="text-muted">Frek angsuran bunga</span><br>
		                                    <b>Bulanan</b>
		                                </div>
		                            </div>

		                        </div>
		                </div>     
		                </a>       
		            <?php
		            }
		            ?>

		                
		            </div>
		                                      
		            </div>
			    </div>
			</div>
		</div>

	  </div>
	</div>	
</div>
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
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>
<!-- Modal -->
