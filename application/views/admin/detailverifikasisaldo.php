
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Detail Saldo</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Verifikasi Saldo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Verifikasi Saldo</h3>
        </div>
        <div class="box-body">
          <div class="col-md-9">
            <form method="post">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" value="<?= $saldo->nama_member ?>" readonly>
            </div>
            <div class="form-group">
              <label>Topup</label>
              <input type="text" class="form-control" value="<?= $saldo->saldo ?>" readonly>
            </div>
            <div class="form-group">
              <label>Nama Bank</label>
              <input type="text" class="form-control" value="<?= $saldo->namabank ?>" readonly>
            </div>
            <div class="form-group">
              <label>No Rekening</label>
              <input type="text" class="form-control" value="<?= $saldo->norekening ?>" readonly>
            </div>
            <div class="form-group">
              <label>Nama di Rekening</label>
              <input type="text" class="form-control" value="<?= $saldo->namarekening ?>" readonly>
            </div>
            <div class="form-group">
              
              <div class="row">
                <?php
              if($saldo->status==0){
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
                  <a href="<?= base_url() ?>admin/verifikasisaldo" class="btn btn-warning btn-block">Back</a>                 
                </div>
              </div>
            </div>
            </form>
          </div>
          <!-- end col 9 -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Bukti Transfer</label><br>
              <img src="<?= base_url()."uploads/bukti/".$saldo->fotobukti ?>" width="100%">
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      


    </section>
    <!-- /.content -->
  </div>