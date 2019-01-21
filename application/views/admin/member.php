<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Members</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Members</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Data member</h3>
        </div>
        <div class="box-body">
          <table id="data-table" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Status</th>
                <th>Saldo</th>
                <th>Kategori</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                foreach($members as $h){
                  $i++;
                  $pengguna=["Peminjam","Investor","Peminjam & Investor"];
              ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $h->nama_member ?></td>
                <td><?= $h->statusverifikasi==0?"Belum":"Verifikasi" ?></td>
                <td><?= $h->saldo ?></td>
                <td><?= $pengguna[$h->statuspengguna] ?></td>
                <td>
                  <a href="<?= base_url() ?>admin/detailmember/<?= $h->id_member ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  <?php
                  if($h->statuspengguna==1){
                  ?>
                  <a href="<?= base_url()?>admin/banned/<?= $h->id_member ?>" class="btn btn-danger"><i class="fa fa-ban"></i></a>
                  <?php
                  }else if($h->statuspengguna==2){
                  ?>
                  <a href="<?= base_url()?>admin/banned/<?= $h->id_member ?>" class="btn btn-danger"><i class="fa fa-unlock"></i></a>
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
      


    </section>
    <!-- /.content -->
  </div>