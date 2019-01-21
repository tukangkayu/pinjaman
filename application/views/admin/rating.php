<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Rating & Review</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rating & Review</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Data Rating & Review</h3>
        </div>
        <div class="box-body">
          <table id="data-table" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Judul Pinjaman</th>
                <th>Jumlah</th>
                <th>Review</th>
                <th>Rating</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                foreach($pinjam as $h){
                  $i++;
                  $member = $this->mmember->ambilSemuaMember(['id_member'=>$h->id_member])[0];
                  $rating = $this->mrating->totalRating($h->id);
              ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $member->nama_member ?></td>
                <td><a href="<?= base_url() ?>admin/detailpinjaman/<?= $h->id ?>"><?= $h->nama_pinjaman ?></a></td>
                <td><?= $h->jumlah_pinjaman ?></td>
                <td><a href="<?= base_url() ?>admin/detailrating/<?= $h->id ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                <td>
                  <?= $rating ?>
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