<div class="row">
  <div class="col-md-12">
    <div class="container">
        <h2>Notification</h2>
        <table id="data-table" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Notification</th>
              <th>Dokumen</th>
              <th>Tgl Dibuat</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no=0;
          foreach($notification as $n){
            $no++;
            $dokumen = $this->mdokumen->getDokumen(array('id'=>$n->id_dokumen));
            $html="";
            if($n->id_dokumen!=0){
              $html = "<a href='".base_url()."uploads/dokumen/".$dokumen[0]->nama."' download class='btn btn-primary'>Download</a>";
            }
          ?>
          <tr>
          <td><?= $no ?></td>
          <td><?=  $n->notification ?></td>
          <td>
            <?= $html ?>
          </td>
          <td><?= $n->tgl_dibuat ?></td>
          </tr>
          <?php
          }
          ?>
          </tbody>
        </table>
    </div>
  </div>
</div>