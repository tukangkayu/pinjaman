
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Banned Member</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banned Member</li>
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
          <div class="col-md-12">
            <form method="post">
            <div class="form-group">
              <input type="hidden" name="statuspengguna" value="<?= $member->statuspengguna ?>">
              <label>Alasan Banned*</label>
              <input type="text" class="form-control" value="<?= $member->alasanbanned ?>" name="alasanbanned">
            </div>
    
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary btn-block"><?= $member->statuspengguna==1?"Banned":"Unbanned"?></button>
                </div>
                <div class="col-md-6">
                  <a href="<?= base_url() ?>admin/member" class="btn btn-warning btn-block">Back</a>                 
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