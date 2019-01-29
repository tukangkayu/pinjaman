<?php
    if($pesan==1){
?>
<div class="alert alert-info" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    Segera Perbaharui Profile anda agar dapat mengajukan atau memberikan pinjaman
</div>
<?php
    }
?>
<!--Section Title-->
<div class="home jumbotron header sm-margin-top-30">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0"></li>
              <li data-target="#myCarousel" data-slide-to="1" ></li>
        </ol>
        <div class="carousel-inner">
         <div class="item active background-blue">
                <div class="carousel-caption">
                    <div class="container">
	                    <h1>
	                        Alternatif pengembangan dana yang aman, mudah, dan menguntungkan
	                    </h1>

                        <p style="font-weight:300; color:#fff;">
                            Berikan pinjaman kepada pelaku Usaha Kecil Menengah (UKM) dan dapatkan imbal hasil rata-rata 18%-21% per tahun. Lebih dari 98% nilai portfolio pinjaman memiliki agunan dan proses pemberian pinjaman berbasis online.
                        </p>
                        <a href="<?= base_url() ?>pinjaman/beripinjaman"
                           class="btn primary font-14px">Berikan Pinjaman</a>
                    </div>
                </div>
            </div>
          <div class="item  background-blue">
                <div class="carousel-caption">
                    <div class="container">
	                    <h1>
	                        Pinjaman usaha fleksibel, sesuai kebutuhan pelaku UKM
	                    </h1>

                        <p style="font-weight:300; color:#fff;">
                            Ajukan pinjaman sesuai dengan kebutuhan unik usaha kamu. Kami dapat menyesuaikan besar pinjaman, tenor pinjaman, agunan, dan frekuensi pembayaran cicilan.
                        </p>
                        <a href="<?= base_url() ?>home/pinjaman"
                           class="btn primary font-14px">Ajukan Pinjaman</a>
                    </div>
                </div>
            </div>             
          </div>
    </div>
</div>
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
	        <div class="text-center">
	            <a href="<?= base_url() ?>pinjaman/beripinjaman" class="btn primary"
	               style="margin-top:30px;">Lihat Lebih Banyak</a>
	        </div>
	    </div>
	</div>
</div>


    <!--/Section Patients-->



    <div class="jumbotron how-it-works" style="min-height:0;">
        <div class="container" style="margin-bottom:0;">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    
                </div>
            </div>
        </div>
    </div>
        <!--/Section Help Our Sustainability-->


