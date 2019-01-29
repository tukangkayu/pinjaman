
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Verifikasi Tagihan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Verifikasi Tagihan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Verifikasi Tagihan</h3>
        </div>
        <div class="box-body">
          <table id="data-table" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Tagihan</th>
                <th>Denda</th>
                <th>Total Tagihan</th>
                <th>Tgl Tagihan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                $status=["Pending","Disetujui","Ditolak"];
                foreach($tagihan as $h){
                  $member = $this->mmember->ambilSemuaMember(array('id_member'=>$h->id_member))[0];
                  $i++;
              ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $member->nama_member ?></td>
                <td><?= $h->totaltagihan ?></td>
                <td><?= $h->denda ?></td>
                <td><?= $h->totaltagihan + $h->denda ?></td>
                <td><?= $h->tgltagihan ?></td>
                <th><?= $status[$h->status] ?></th>
                <td>
                	<a href="<?= base_url() ?>admin/detailverifikasitagihan/<?= $h->id ?>" class="btn btn-primary"><?= $h->status==0?"Verifikasi":"Detail" ?></a>
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