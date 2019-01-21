
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Verifikasi Pinjaman</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Verifikasi Pinjaman</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Verifikasi Pinjaman</h3>
        </div>
        <div class="box-body">
          <table id="data-table" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Judul Pinjaman</th>
                <th>Total Pinjaman</th>
                <th>Tenor</th>
                <th>Bunga</th>
                <th>Jenis Pinjaman</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                $kategori = ["Personal","UKM Kecil","Perusahaan Besar"];
                foreach($pinjaman as $h){
                  $member=$this->mmember->ambilSemuaMember(['id_member'=>$h->id_member])[0];
                  $i++;
              ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $member->nama_member ?></td>
                <td><?= $h->nama_pinjaman ?></td>
                <td><?= $h->jumlah_pinjaman ?></td>
                <td><?= $h->lama_pinjaman ?> Bulan</td>
                <td><?= $h->bunga_efektif ?>%</td>
                <td><?= $kategori[$h->kategori_pinjaman] ?> </td>
                <td>
                	<a href="<?= base_url() ?>admin/detailverifikasipinjaman/<?= $h->id ?>" class="btn btn-primary">Verifikasi</a>
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