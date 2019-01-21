<div class="row">
  <div class="col-md-12">
    <div class="container">
      <h2 >History Tagihan</h2>
        <table id="data-table" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Angsuran ke</th>
              <th>Total Tagihan</th>
              <th>Tgl Tagihan</th>
              <th>Denda</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
            foreach($tagih as $d){
              $no++;
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $d->angsuranke ?></td>
              <td><?= $d->totaltagihan ?></td>
              <td><?= $d->tgltagihan ?></td>
              <td><?= $d->denda ?></td>
              <td><?= $d->status==0?"Belum Dibayar":"Dibayar" ?></td>
              <td>
                <a href="<?= base_url() ?>pinjaman/detailtagihan/<?= $d->id ?>" class="btn btn-primary"><?= $d->status==0?"Bayar":"Detail" ?></a>
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