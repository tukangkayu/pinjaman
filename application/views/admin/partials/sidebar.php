<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li><a href="<?= base_url() ?>admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-list-alt"></i> <span>Notifikasi</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= base_url() ?>admin/verifikasimember">Verifikasi Data Profil</a></li>
          <li><a href="<?= base_url() ?>admin/verifikasisaldo">Verifikasi Saldo Elektronik</a></li>
          <li><a href="<?= base_url() ?>admin/verifikasipinjaman">Verifikasi Ajukan Pinjaman</a></li>
          <li><a href="<?= base_url() ?>admin/verifikasipindahdana">Verifikasi Pemindahan Dana</a></li>
          <li><a href="<?= base_url() ?>admin/verifikasipencairan">Verifikasi Pencarian Dana</a></li>
          <li><a href="<?= base_url() ?>admin/verifikasitagihan">Verifikasi Angsuran & Denda</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-list-alt"></i> <span>Data Master</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= base_url() ?>admin/member">Data Member</a></li>
          <li><a href="<?= base_url() ?>admin/pinjaman">Data Pinjaman</a></li>
          <li><a href="<?= base_url() ?>admin/rating">Data Review & Rating</a></li>
        </ul>
      </li>
      <li><a href="<?= base_url() ?>admin/logout"><i class="fa fa-table"></i> <span>Logout</span></a></li>
  </section>
  <!-- /.sidebar -->
</aside>