
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Detail Pemindahan Dana</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Verifikasi Pemindahan Dana</li>
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
          <div class="col-md-12">
            <form method="post">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" value="<?= $member->nama_member ?>" readonly>
            </div>
            <div class="form-group">
              <label>Judul Pinjaman</label>
              <input type="text" class="form-control" value="<?= $pinjam->nama_pinjaman ?>" readonly>
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="text" class="form-control" value="<?= $dana->jumlah ?>" readonly>
            </div>
            <div class="form-group">
              
              <div class="row">
                <?php
              if($dana->status==0){
              ?>
                <div class="col-md-6">
                   <button type="submit" name="approve" class="btn btn-primary btn-block">Approve</button>
                </div>
                <div class="col-md-6">
                  <button type="submit" name="reject" class="btn btn-danger btn-block">Reject</button>
                </div>
              <?php } ?>

              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <a href="<?= base_url() ?>admin/verifikasipindahdana" class="btn btn-warning btn-block">Back</a>                 
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      


    </section>
    <!-- /.content -->
  </div>