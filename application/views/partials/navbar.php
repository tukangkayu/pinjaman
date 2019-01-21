

<nav class="navbar navbar-default navbar-fixed-top" id="fixedbar">

    <div class="container subMenu">
      <div class="col-md-12">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span style="color:#4399D6;">Menu</span>
        </button>
        <a class="navbar-brand" href="<?= base_url() ?>">
          <span class="cl-logo hidden-xs">Pinjaman</span>
        </a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li><a href="<?= base_url() ?>home/pinjaman" >Pinjaman</a></li>
          <li><a href="<?= base_url() ?>pinjaman/beripinjaman">Berikan Pinjaman</a></li>
          <li><a href="<?= base_url() ?>home/tentang">Tentang Kami</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
            if(isset($_SESSION['id_member'])){
              $member= $this->Mmember->ambilSemuaMember(array('id_member'=>$_SESSION['id_member']))[0];
              $notification = $this->mnotification->userNotification(array('id_member'=>$_SESSION['id_member'],'is_read'=>0));
            ?>
            <li><a href="<?= base_url() ?>member/detailsaldo" id="nav-login" ><b class="raised auto-numeric" data-a-sep="." data-a-dec="," data-a-sign="Rp."><?= $member->saldo ?></b></a></li>
            <li class="language-dropdown dropdown nav-cust">
              <button class="dropdown-toggle" type="button" data-toggle="dropdown" language-dropdown="" aria-expanded="true"><?= $_SESSION['nama_member'] ?><span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="<?= base_url()?>member/notification">Notifikasi <span class="badge badge-primary badge-pill"><?= count($notification) ?></span></a></li>
                <li><a href="<?= base_url() ?>member/profile">Lihat Profile</a></li>
                <li><a href="<?= base_url() ?>pinjaman/investasi">Profil Investasi</a></li>
                <li><a href="<?= base_url() ?>pinjaman/listpinjaman">List Pinjaman</a></li>
                <li><a href="<?= base_url() ?>member/dokumen">Dokumen</a></li>
                 <li class="nav-divider"></li>
                <li><a href="<?= base_url() ?>login/logout">Logout</a></li>
              </ul>
            </li>

            <?php
            }else{
          ?>
            <li><a href="<?= base_url() ?>login"  id="nav-login">Login</a></li>
            <li><a href="<?= base_url() ?>login/register" id="nav-signup" style="color:#3a9fd7">Register</a></li>
            <?php } ?>      
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>
    <!-- /Login Modal -->
  </nav>
  <script type="text/javascript">
      $( document ).ready(function() {
          $(window).scroll(function() {
              if($(this).scrollTop()>0){
                  $(".nav-blue").addClass("blue-show");
              }
              else{
                  $(".nav-blue").removeClass("blue-show");
              }
          })
      });
  </script>
