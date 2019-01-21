 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= count($member) ?></h3>
              <p>Menunggu verifikasi data profil</p>
            </div>
            <a href="<?= base_url() ?>admin/verifikasimember" class="small-box-footer">Lebih Lengkap <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= count($saldo) ?></h3>
              <p>Menunggu verifikasi saldo pending</p>
            </div>
            <a href="<?= base_url() ?>admin/verifikasisaldo" class="small-box-footer">Lebih Lengkap <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= count($pinjaman) ?></h3>
              <p>Menunggu verifikasi pengajuan pinjaman</p>
            </div>
            <a href="<?= base_url() ?>admin/verifikasipinjaman" class="small-box-footer">Lebih Lengkap <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= count($dana) ?></h3>
              <p>Menunggu verifikasi pemindahan dana</p>
            </div>
            <a href="<?= base_url() ?>admin/verifikasipindahdana" class="small-box-footer">Lebih Lengkap <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= count($pencairan) ?></h3>
              <p>Menunggu verifikasi pencarian dana</p>
            </div>
            <a href="<?= base_url() ?>admin/verifikasipencairan" class="small-box-footer">Lebih Lengkap <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>0</h3>
              <p>Menunggu verifikasi angsuran & denda</p>
            </div>
            <a href="<?= base_url() ?>" class="small-box-footer">Lebih Lengkap <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>