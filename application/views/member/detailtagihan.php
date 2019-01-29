<div class="row">
  <div class="col-md-12">
    <div class="container">
      <h2 >History Tagihan</h2>
        <table id="data-table" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Angsuran ke</th>
              <th>Tagihan</th>
              <th>Denda</th>
              <th>Total Tagihan</th>
              <th>Tgl Tagihan Berakhir</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
            foreach($tagih as $d){
              $no++;
              $tgl = strtotime($d->tgltagihan);
              $now = strtotime(Date("Y-m-d"));
              $jarak = $tgl-$now;
              $jarak = $jarak/ (60 * 60 * 24);
              $status=["Belum Dibayar","Dibayar","Ditolak"];
              if($jarak<=5){
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $d->angsuranke ?></td>
              <td><?= $d->totaltagihan ?></td>
              <td><?= $d->denda ?></td>
              <td><?= $d->totaltagihan + $d->denda ?></td>
              <td><?= $d->tgltagihan ?></td>
              <td><?= $status[$d->status] ?></td>
              <td>
                <?php
                if($d->fotobukti==''){
                ?>
                  <a href="<?= base_url() ?>pinjaman/bayartagihan/<?= $d->id ?>" class="btn btn-primary">Bayar</a>        
                <?php
                }else{
                ?>
                <a class="btn btn-primary" data-src="<?= base_url() ?>uploads/tagihan/<?= $d->fotobukti ?>" data-toggle="modal" data-target="#modal-bukti">Lihat Bukti</a>
                <?php
                }
                ?>
      
              </td>
            </tr>
            <?php
              }
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