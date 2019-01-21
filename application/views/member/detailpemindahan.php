<div class="row">
  <div class="col-md-12">
    <div class="container">
  <?php
  if(isset($_COOKIE['pesan_listpinjaman'])):
  ?>
  <div class="alert alert-info" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <?= $_COOKIE['pesan_listpinjaman']; ?>
  </div>
  <?php unset($_COOKIE['pesan_listpinjaman']);setcookie('pesan_listpinjaman','',time()-3600,'/'); endif;?>
        <h2>List Pemindahan dana</h2>
        <p>
          <a href="<?= base_url() ?>pinjaman/listpinjaman" class="btn btn-primary">Back</a>
        </p>
        <table id="data-table" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Pemberi</th>
              <th>Jumlah</th>
              <th>Tgl pemindahan</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no=0;
          foreach($pindah as $p){
            $member = $this->Mmember->ambilSemuaMember(['id_member'=>$p->id_member])[0];
            $no++;
          ?>
          <tr>
          <td><?= $no ?></td>
          <td><?=  $member->nama_member ?></td>
          <td>
            <?= $p->jumlah ?>
          </td>
          <td><?= $p->created_at ?></td>
          </tr>
          <?php
          }
          ?>
          </tbody>
        </table>
    </div>
  </div>
</div>