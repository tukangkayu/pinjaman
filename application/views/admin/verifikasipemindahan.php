
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Verifikasi Pemindahan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Verifikasi Pemindahan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Verifikasi Pemindahan dana</h3>
        </div>
        <div class="box-body">
          <table id="data-table" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Pemberi Dana</th>
                <th>Judul Pinjaman</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tgl Dibuat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                foreach($dana as $h){
                  $member = $this->mmember->ambilSemuaMember(array('id_member'=>$h->id_member))[0];
                  $pinjam = $this->mpinjaman->ambilPinjaman(['id'=>$h->id_pinjaman])[0];
                  $i++;
              ?>
              <tr>
                <td><?= $i ?></td>
                <td><a href="<?= base_url() ?>admin/detailmember/<?= $member->id_member ?>" target="_blank"></a><?= $member->nama_member ?></td>
                <td><?= $pinjam->nama_pinjaman ?></td>
                <td><?= $h->jumlah ?></td>
                <th><?= $h->status==0?"Pending":"Diterima" ?></th>
                <td><?= $h->created_at ?></td>
                <td>
                	<a href="<?= base_url() ?>admin/detailverifikasipindah/<?= $h->id ?>" class="btn btn-primary"><?= $h->status==0?"Verifikasi":"Detail" ?></a>
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