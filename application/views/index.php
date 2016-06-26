<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Penjadwalan Teknisi - <?php echo $judul; ?></title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url(); ?>assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url(); ?>assets/js/html5shiv.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
		<![endif]-->
                
                <!--[if !IE]> -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
                <script src="<?php echo base_url(); ?>assets/js/jquery.1.11.1.min.js"></script>
                <![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
                <script type="text/javascript">
                 window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery1x.min.js'>"+"<"+"/script>");
                </script>
                <![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?php echo base_url(); ?>" class="navbar-brand">
						<small>
							<i class="fa fa-users"></i>
							Penjadwalan Teknisi
						</small>
					</a>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<?php $this->load->view('sidebar'); ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
                                                    <?php foreach ($menu as $item) { ?>
                                                    <li class=""><?php echo $item; ?></li>
                                                    <?php } ?>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<?php $this->load->view($konten); ?>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Penjadwalan Teknisi</span>
							&copy; 2016
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->
                
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="<?php echo base_url(); ?>assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url().'assets/js/jquery-ui.custom.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.ui.touch-punch.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.easypiechart.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.sparkline.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.flot.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.flot.pie.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.flot.resize.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/chosen.jquery.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/fuelux.spinner.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/bootstrap-datepicker.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/bootstrap-timepicker.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/moment.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/daterangepicker.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/bootstrap-datetimepicker.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/bootstrap-colorpicker.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.knob.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.autosize.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.inputlimiter.1.3.1.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/jquery.maskedinput.min.js'; ?>"></script>
                <script src="<?php echo base_url().'assets/js/bootstrap-tag.min.js'; ?>"></script>

		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.tableTools.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.colVis.min.js"></script>
                
                <!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(document).ready(function() {
                //initiate dataTables plugin
                var oTable1 = 
                $('#dynamic-table')
                .wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable( {
                    bAutoWidth: false,
      //               "aoColumns": [
						// { "bSortable": false },
						// null, null,null, null, null,
						// { "bSortable": false }
      //               ],
      //               "aaSorting": [],

                    //,
                    "sScrollY": "350px",
                    //"bPaginate": false,

                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50,
                    
                    "language": {
                        "lengthMenu": "Menampilkan _MENU_ data per halaman",
                        "zeroRecords": "Maaf, tidak ada data yang ditampilkan.",
                        "info": "Halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "search": "Cari:",
                        "decimal": ",",
                        "thousands": ".",
                        "paginate": {
                            "previous": "<",
                            "next": ">",
                            "first": "<<",
                            "last": ">>"
                        },
                        "infoFiltered": "(Penyaringan dari _MAX_ total data)"
                    }
				});
                // oTable1.fnAdjustColumnSizing();
                
                // date-picker plugin
                $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
            });
		</script>
	</body>
</html>
