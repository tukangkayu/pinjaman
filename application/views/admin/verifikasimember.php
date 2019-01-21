
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Verifikasi Member</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Verifikasi Member</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Verifikasi member</h3>
        </div>
        <div class="box-body">
          <table id="data-table" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Tgl mendaftar</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                foreach($members as $h){
                  $status=['pending','diverifikasi','ditolak'];
                  $i++;
              ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $h->nama_member ?></td>
                <td><?= $h->created_at ?></td>
                <td><?= $status[$h->statusverifikasi] ?></td>
                <td>
                	<a href="<?= base_url() ?>admin/detailverifikasimember/<?= $h->id_member ?>" class="btn btn-primary">Verifikasi</a>
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