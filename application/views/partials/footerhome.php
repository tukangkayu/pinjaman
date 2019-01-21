<!--Section Footer-->
<footer class="jumbotron footer background-blue">
  <div class="container footer-cust" style="margin-bottom:20px;">
    <div class="col-sm-4  col-xs-12">
      <span class="hidden-xs" style="color: white">Pinjaman</span>
      <p style="font-size:12px;color:white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <ul class="nav">
          <li>
          	<a class="socmed" href="#"><i class="fa fa-facebook-f"></i></a>
          </li>
           <li>
          	<a class="socmed" href="#"><i class="fa fa-instagram"></i></a>
          </li>
           <li>
          	<a class="socmed" href="#"><i class="fa fa-twitter"></i></a>
          </li>
           <li>
          	<a class="socmed" href="#"><i class="fa fa-linkedin"></i></a>
          </li>
        </ul>
      </div>
      <div class="col-xs-6 col-md-2 col-sm-4 col-xs-12">
      	<br>
        <ul class="nav">
          <li><a href="#">Beri Pinjaman</a></li>
          <li><a href="#">Ajukan Pinjaman</a></li>
          <li><a href="#">Tentang Kami</a></li>
          <li><a href="#">Hubungi Kami</a></li>
        </ul>
      </div>
    </div>
    <!-- end nav footer -->
    <div class="jumbotron" >
		<div class="container" style="padding-top:10px;margin-bottom:0;">
	        <div class="col-md-12">
	          <p class="copyright-copy" style="color: #898989; font-size: 7pt;">©2018 <a
            href="#"><span style="color:#4399D6;font-weight:bold;">PT. Pinjaman Indonesia</span></a></p>
	        </div>
        </div>
    </div>
    </footer>


<!-- DataTables -->
<script src="<?= base_url() ?>libraries/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>libraries/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#data-table").DataTable({});
        $(".data-table").DataTable({});
        $('.auto-numeric').autoNumeric('init', {
            'aSep': '.',
            'aDec': ',',

            'vMin': '0',
            'vMax': '999999999999'
        });
    });
</script>


</body>
</html>