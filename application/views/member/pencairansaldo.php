<div class="row">
  <div class="col-md-12">
    <div class="container">
      <h2 >Pencairan saldo</h2>
      <div class="row">
        <form method="post">
          <div class="col-md-8">
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" max="<?= $member->saldo ?>" placeholder="Masukkan jumlah" required="" >
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
        <h2>History Pencairan saldo</h2>
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