<div class="row">
  <div class="col-md-12">
    <div class="container">
      <h2>Saldo</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Saldo Saat Ini</label>
            <input type="text" class="auto-numeric" value="<?= $member->saldo ?>" readonly="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Saldo Pinjaman Saat Ini</label>
            <input type="text" class="auto-numeric" value="<?= $banyakcair>0?$totalcair*0.99:$totalcair; ?>" readonly="">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Saldo sedang investasi</label>
            <input type="text" class="auto-numeric" value="<?= $totalinvestasi ?>" readonly="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Saldo Pinjaman bisa dicairkan</label>
            <input type="text" class="auto-numeric" value="<?= $totalcair*0.99 ?>" readonly="">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Total Topup</label>
            <input type="text" class="auto-numeric" value="<?= $totalTopup ?>" readonly="">
          </div>
        </div>
        <div class="col-md-6">
           <div class="form-group">
            <label>&nbsp;</label>
            <a href="<?= base_url() ?>member/topup" class="btn btn-primary btn-block">Topup saldo</a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
         <!--  <div class="form-group">
            <label>Total bunga yang diterima</label>
            <input type="text" class="auto-numeric" value="10000" readonly="">
          </div> -->

        </div>
        <div class="col-md-6">
           <div class="form-group">
            <label>&nbsp;</label>
            <a href="<?= base_url() ?>member/pencairansaldo" class="btn btn-primary btn-block">Cairkan saldo</a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
           <div class="form-group">
            <label>&nbsp;</label>
            <a href="<?= base_url() ?>member/pencairanpinjaman" class="btn btn-primary btn-block">Cairkan saldo pinjaman</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>