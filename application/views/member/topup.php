<div class="row">
  <div class="col-md-12">
    <div class="container">
      <h2 >Topup</h2>
      <div class="row">
        <form method="post">
          <div class="col-md-8">
              <div class="form-group">
                <label>Jumlah</label>
                <input type="text" class="form-control" name="jumlah" placeholder="Masukkan jumlah ingin ditopup">
              </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <br>
              <button class="btn btn-primary btn-block" type="submit">Topup</button>
            </div>
          </div>      
        </form>  
      </div>
      
        <hr>
        <h2>History Topup</h2>
        <table id="data-table" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Jumlah</th>
              <th>Status</th>
              <th>Tgl Topup</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
            foreach($topup as $t){
              $no++;
            ?>
            <td><?= $no ?></td>
            <td><?=  $t->saldo ?></td>
            <td><?= $t->status==0?"Pending":"Berhasil" ?></td>
            <td><?= $t->created_at ?></td>
            <td>
              <?php
              if($t->fotobukti==''){
              ?>
                <a href="<?= base_url() ?>member/uploadbukti/<?= $t->id_saldo ?>" class="btn btn-primary">Konfirmasi</a>              
              <?php
              }else{
              ?>
              <a class="btn btn-primary" data-src="<?= base_url() ?>uploads/bukti/<?= $t->fotobukti ?>" data-toggle="modal" data-target="#modal-bukti">Lihat Bukti</a>
              <?php
              }
              ?>
            </td>
            <?php
            }
            ?>
          </tbody>
        </table>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-bukti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Bukti Pembayaran</h4>
          </div>
      
          <div class="modal-body">
              <img src="" width="300" id="fotobukti">
          </div>
          
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>
<!-- Modal -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#modal-bukti').on('show.bs.modal', function(e) {
        $(this).find('#fotobukti').attr('src',$(e.relatedTarget).data('src'));
    });
  })
</script>