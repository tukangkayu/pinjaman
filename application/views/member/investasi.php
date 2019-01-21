<div class="row">
  <div class="col-md-12">
    <div class="container">
      <h2 >Profile Investasi</h2>
        <table id="data-table" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul Pinjaman</th>
              <th>Jumlah</th>
              <th>Status</th>
              <th>Tgl Dibuat</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
            foreach($dana as $d){
              $no++;
              $pinjaman = $this->mpinjaman->ambilPinjaman(['id'=>$d->id_pinjaman])[0];
            ?>
            <td><?= $no ?></td>
            <td><?=  $pinjaman->nama_pinjaman ?></td>
            <td><?= $d->jumlah ?></td>
            <td><?= $d->status==0?"Pending":"Berhasil" ?></td>
            <td><?= $d->created_at ?></td>
            <?php
            }
            ?>
          </tbody>
        </table>
    </div>
  </div>
</div>
