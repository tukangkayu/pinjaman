
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Detail Rating</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Rating</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Data Rating</h3>
        </div>
        <div class="box-body">
          <p>
            <a href="<?= base_url() ?>admin/rating" class="btn btn-warning">Back</a>
          </p>
          <table id="data-table" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Tgl Dibuat</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                foreach($rating as $h){
                  $member = $this->mmember->ambilSemuaMember(array('id_member'=>$h->id_member))[0];
                  $pinjam = $this->mpinjaman->ambilPinjaman(['id'=>$h->id_pinjaman])[0];
                  $i++;
              ?>
              <tr>
                <td><?= $i ?></td>
                <td><a href="<?= base_url() ?>admin/detailmember/<?= $member->id_member ?>" target="_blank"></a><?= $member->nama_member ?></td>
                <td><?= $h->rating ?></td>
                <th><?= $h->isi ?></th>
                <td><?= $h->created_at ?></td>
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