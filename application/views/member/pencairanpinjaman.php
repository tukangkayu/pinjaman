<div class="row">
  <div class="col-md-12">
    <div class="container">
<?php
  if(isset($_COOKIE['pesan_pencairanpinjaman'])):
  ?>
  <div class="alert alert-info" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <?= $_COOKIE['pesan_pencairanpinjaman']; ?>
  </div>
  <?php unset($_COOKIE['pesan_pencairanpinjaman']);setcookie('pesan_pencairanpinjaman','',time()-3600,'/'); endif;?>
      <h2 >Pencairan saldo pinjaman</h2>
      <div class="row">
        <form method="post">
          <div class="col-md-8">
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" min="10000"  class="form-control" placeholder="Masukkan jumlah" required="">
              </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <br>
              <button class="btn btn-primary btn-block" type="submit">Cairkan</button>
            </div>
          </div>      
        </form>  
      </div>
      
        <hr>
        <h2>History Pencairan saldo pinjaman</h2>
        <table id="data-table" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Jumlah</th>
              <th>Status</th>
              <th>Tgl Topup</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
            foreach($pencairan as $t){
              $no++;
              $status=["Pending","Berhasil","Ditolak"];
            ?>
            <tr>
            <td><?= $no ?></td>
            <td><?=  $t->jumlah ?></td>
            <td><?= $status[$t->status] ?></td>
            <td><?= $t->created_at ?></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
    </div>
  </div>
</div>
<script type="text/javascript">
  var max = "<?= $maxcair*0.99 ?>";

  // var jumlah = $("#jumlah");
  var jumlah=document.getElementById("jumlah");
  function validate(){
      if(parseInt(jumlah.value)>parseInt(max)){
          jumlah.setCustomValidity("Saldo tidak cukup untuk ditarik.Max ditarik adalah "+max);
      }else{
          jumlah.setCustomValidity("");
      }
  }
  jumlah.onchange=validate;
  jumlah.onkeyup=validate;
</script>