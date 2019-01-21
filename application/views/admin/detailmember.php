
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Detail Member</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Member</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COLOR PALETTE -->
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>Detail member</h3>
        </div>
        <div class="box-body">
          <div class="col-md-9">
            <form method="post">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" value="<?= $member->nama_member ?>" readonly>
            </div>
            <div class="form-group">
              <label>Nomor KTP</label>
              <input type="text" class="form-control" value="<?= $member->noktp ?>" readonly>
            </div>
            <div class="form-group">
              <label>Alamat Lengkap</label>
              <input type="text" class="form-control" value="<?= $member->alamat ?>" readonly>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label>Handphone 1</label>
                  <input type="text" class="form-control" value="<?= $member->handphone1 ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label>Handphone 2</label>
                  <input type="text" class="form-control" value="<?= $member->handphone2 ?>" readonly>
                </div>
                
              </div>

            </div>
            <div class="form-group">
              <label>Nama Bank</label>
              <input type="text" class="form-control" value="<?= $member->namabank ?>" readonly>
            </div>
            <div class="form-group">
              <label>No Rekening</label>
              <input type="text" class="form-control" value="<?= $member->norekening ?>" readonly>
            </div>
            <div class="form-group">
              <label>Nama di Rekening</label>
              <input type="text" class="form-control" value="<?= $member->namarekening ?>" readonly>
            </div>
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <a href="<?= base_url() ?>admin/member" class="btn btn-warning btn-block">Back</a>                 
                </div>
              </div>
            </div>
          </form>
          </div>
          <!-- end col 9 -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Foto Profile</label><br>
              <img src="<?= base_url()."uploads/profile/".$member->fotoprofil ?>" width="100%">
            </div>
            <div class="form-group">
              <label for="">Foto Ktp</label><br>
              <img src="<?= base_url()."uploads/ktp/".$member->fotoktp ?>" width="100%">
            </div>
            <div class="form-group">
              <label for="">Foto Buku Tabungan</label><br>
              <img src="<?= base_url()."uploads/tabungan/".$member->fotobukutabungan ?>" width="100%">
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      


    </section>
    <!-- /.content -->
  </div>