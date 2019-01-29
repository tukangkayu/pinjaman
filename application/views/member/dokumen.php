<div class="row">
  <div class="col-md-12">
    <div class="container">
      <h2 >Dokumen</h2>
        <table id="data-table" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Jenis</th>
              <th>Tgl Dibuat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
            foreach($dokumen as $d){
              $no++;
            ?>
            <tr>
            <td><?= $no ?></td>
            <td><?=  $d->jenis ?></td>
            <td><?= $d->created_at ?></td>
            <td>
                <a href="<?= base_url() ?>dokumen/<?= $d->nama ?>" class="btn btn-primary" download>Download</a>
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