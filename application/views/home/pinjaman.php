<div class="container">
	<div class="row">
  <?php
	if(isset($_COOKIE['pesan_pinjaman'])):
	?>
	<div class="alert alert-info" role="alert">
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	  <?= $_COOKIE['pesan_pinjaman']; ?>
	</div>
	<?php unset($_COOKIE['pesan_pinjaman']);setcookie('pesan_pinjaman','',time()-3600,'/'); endif;?>
	  <div class="col-md-12">
	    <h2 >Pinjaman</h2>
		<div class="row">
			<div class="col-md-9">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<a href="<?= base_url() ?>pinjaman/ajukanpinjaman" class="btn btn-primary">Ajukan Pinjaman</a>
			</div>
			<div class="col-md-3">
				<img src="<?= base_url() ?>uploads/noimage.png" style="max-height: 200px;width: 100%">
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-3">
				<img src="<?= base_url() ?>uploads/noimage.png" style="max-height: 200px;width: 100%">
			</div>
			<div class="col-md-9">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<a class="btn btn-primary"  data-toggle="modal" data-target="#modal-cara-pengajuan">Cara Pengajuan Pinjaman</a>
			</div>
		</div>
	  </div>
	</div>	
</div>
<!-- Modal -->
<div class="modal fade" id="modal-cara-pengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Cara Pengajuan</h4>
          </div>
      
          <div class="modal-body">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>
<!-- Modal -->
