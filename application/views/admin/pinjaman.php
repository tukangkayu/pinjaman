<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Data Pinjaman</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pinjaman</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Data Pinjaman Sedang Berjalan</h3>
        </div>
        <div class="box-body">
<?php
  if(isset($_COOKIE['pesan_kembalidana'])):
  ?>
  <div class="alert alert-info" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <?= $_COOKIE['pesan_kembalidana']; ?>
  </div>
  <?php unset($_COOKIE['pesan_kembalidana']);setcookie('pesan_kembalidana','',time()-3600,'/'); endif;?>
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Judul Pinjaman</th>
                <th>Total Pinjaman</th>
                <th>Tenor</th>
                <th>Bunga</th>
                <th>Jenis Pinjaman</th>
                <th>Akhir</th>
                <th width="180">Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            $kategori = ["Personal","UKM Kecil","Perusahaan Besar"];
            foreach($pinjamanjalan as $h){
                $member=$this->mmember->ambilSemuaMember(['id_member'=>$h->id_member])[0];
                $i++;
                $day=strtotime(Date("Y-m-d"))-(strtotime($h->updated_at));
                $day = $day / (60 * 60 * 24);
                $day= (int)$day;
                  // $enddays = strtotime('+'.(30-$day).' days', strtotime($p->updated_at));
                $enddays = strtotime('+1 month', strtotime($h->updated_at));
                $enddays = strtotime('-'.($day).' days', $enddays);
                $end = $enddays - strtotime($h->updated_at);
                $text = $end<=0?"Berakhir":($end / (60 * 60 * 24))." hari lagi";
              ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $member->nama_member ?></td>
                <td><?= $h->nama_pinjaman ?></td>
                <td><?= $h->jumlah_pinjaman ?></td>
                <td><?= $h->lama_pinjaman ?> Bulan</td>
                <td><?= $h->bunga_efektif ?>%</td>
                <td><?= $kategori[$h->kategori_pinjaman] ?> </td>
                <td><?= $text ?></td>
                <td>
                  <a href="<?= base_url() ?>admin/detailpinjaman/<?= $h->id ?>" class="btn btn-primary">Detail</a>
                  
                  <?php
                    if($end<=0){
                    ?>
                    <a href="<?= base_url() ?>admin/kembalikanpinjaman/<?= $h->id ?>" class="btn btn-primary">Kembalikan Dana</a>
                    <?php
                    }else{
                    ?>
                    <a href="<?= base_url() ?>admin/historypinjaman/<?= $h->id ?>" class="btn btn-primary">History</a>
                    <?php
                    }
                  ?>
                </td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>

       <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Data Pinjaman Selesai</h3>
        </div>
        <div class="box-body">
          <table  class="table table-bordered data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Judul Pinjaman</th>
                <th>Jumlah</th>
                <th>Tenor</th>
                <th>Bunga</th>
                <th>Jenis Pinjaman</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            $kategori = ["Personal","UKM Kecil","Perusahaan Besar"];
            foreach($pinjamanselesai as $h){
              $member=$this->mmember->ambilSemuaMember(['id_member'=>$h->id_member])[0];
              $i++;
              $status =  date("d-m-Y",strtotime($h->start_at))=="30-11--0001"?"Tidak Terkumpul":"Terkumpul";
              ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $member->nama_member ?></td>
                <td><?= $h->nama_pinjaman ?></td>
                <td><?= $h->jumlah_pinjaman ?></td>
                <td><?= $h->lama_pinjaman ?> Bulan</td>
                <td><?= $h->bunga_efektif ?>%</td>
                <td><?= $kategori[$h->kategori_pinjaman] ?> </td>
                <td><?= $status ?></td>
                <td>
                  <a href="<?= base_url() ?>admin/detailpinjaman/<?= $h->id ?>" class="btn btn-primary">Detail</a>
                  <a href="<?= base_url() ?>admin/historypinjaman/<?= $h->id ?>" class="btn btn-primary">History</a>
                </td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      


    </section>
    <!-- /.content -->
  </div>