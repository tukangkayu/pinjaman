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
        <h2>List Pinjaman sedang berlangsung</h2>
        <table id="data-table" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul Pinjaman</th>
              <th>Jumlah</th>
              <th>Tenor</th>
              <th>Bunga</th>
              <th>Tgl Diajukan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no=0;
          foreach($pinjaman1 as $p){
            $detail = $this->mpinjaman->detailPinjaman(['id_pinjaman'=>$p->id]);
            $no++;
          ?>
          <tr>
          <td><?= $no ?></td>
          <td><?=  $p->nama_pinjaman ?></td>
          <td>
            <?= $p->jumlah_pinjaman ?>
          </td>
          <td><?= $p->lama_pinjaman ?> Bulan</td>
          <td><?= $p->bunga_efektif ?>%</td>
          <td><?= $p->created_at ?></td>
          <td>
            <?php
              if(count($detail)==0){
              ?>
              <a href="<?= base_url() ?>pinjaman/infopinjaman/<?= $p->id ?>" class="btn btn-primary">Isi Detail</a>
              <?php
              }else{
              ?>
              <a href="<?= base_url() ?>pinjaman/detailpinjaman/<?= $p->id ?>" class="btn btn-primary">Detail</a>
              <a href="<?= base_url() ?>pinjaman/detailpemindahan/<?= $p->id ?>" class="btn btn-primary">Pemindahan Dana</a>
              <a href="<?= base_url() ?>pinjaman/tagihan/<?= $p->id ?>" class="btn btn-primary">Tagihan</a>
              <?php
              }
            ?>
          </td>
          </tr>
          <?php
          }
          ?>
          </tbody>
        </table>
        <hr>
        <h2>List Pinjaman pending</h2>
        <table id="data-table" class="table table-bordered data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul Pinjaman</th>
              <th>Jumlah</th>
              <th>Tenor</th>
              <th>Bunga</th>
              <th>Tgl Diajukan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no=0;
          foreach($pinjaman3 as $p){
            $detail = $this->mpinjaman->detailPinjaman(['id_pinjaman'=>$p->id]);
            $no++;
          ?>
          <tr>
          <td><?= $no ?></td>
          <td><?=  $p->nama_pinjaman ?></td>
          <td>
            <?= $p->jumlah_pinjaman ?>
          </td>
          <td><?= $p->lama_pinjaman ?> Bulan</td>
          <td><?= $p->bunga_efektif ?>%</td>
          <td><?= $p->created_at ?></td>
          <td>
            <?php
              if(count($detail)==0){
              ?>
              <a href="<?= base_url() ?>pinjaman/infopinjaman/<?= $p->id ?>" class="btn btn-primary">Isi Detail</a>
              <?php
              }else{
              ?>
              <a href="<?= base_url() ?>pinjaman/detailpinjaman/<?= $p->id ?>" class="btn btn-primary">Detail</a>
              <a href="<?= base_url() ?>pinjaman/detailpemindahan/<?= $p->id ?>" class="btn btn-primary">Pemindahan Dana</a>
              <?php
              }
            ?>
          </td>
          </tr>
          <?php
          }
          ?>
          </tbody>
        </table>
    </div>
  </div>
</div>