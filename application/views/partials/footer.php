<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 3.0
    </div>
    <strong>Copyright &copy; <?= Date("Y") ?> <a href="#">Pinjaman</a>.</strong> All rights
    reserved.
</footer>

</div>

<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>libraries/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>libraries/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>libraries/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>libraries/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url() ?>libraries/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>libraries/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<!-- DataTables -->
<script src="<?= base_url() ?>libraries/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>libraries/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>libraries/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>libraries/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url() ?>libraries/adminlte/dist/js/adminlte.min.js"></script>
<script>
	$(document).ready(function(){
		$('.select2').select2()
		$("#data-table").DataTable({});
		$(".data-table").DataTable({});
	})
</script>
</body>
</html>
