<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Codeigniter | Starter</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/') ?>bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/') ?>bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/') ?>dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/') ?>dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/') ?>SweetAlert2/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/') ?>DataTables/datatables.min.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style type="text/css">
	.help-block.error {
		color: red;
	}

	.user-panel > .image > img {
		width: 45px;
		height: 45px;
		/*height: auto;*/
	}

	.palette {
		background-color: red;
		min-height: 30px;
		min-width: 4%;
		max-height: 30px;
		max-width: 6%;
		line-height: 35px;
		display: flex;
		justify-content: center;
		border: 1px solid black;
		float: left;
		margin-left: 1.3px;
		margin-top: 1.8px;
	}

	.swal2-popup { font-size: 1.6rem !important; }
	</style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="sidebar-mini hold-transition skin-blue fixed">
<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="<?php echo base_url() ?>" target="_blank" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>UIN</b>SU</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>UINSU</b> ILKOM</span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="<?php echo (!empty($user->photo))?base_url('uploads/'.$user->photo):base_url('assets/adminlte/dist/img/user2-160x160.jpg') ?>" class="user-image" alt="User Image">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs"><?php echo $user->full_name ?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="<?php echo (!empty($user->photo))?base_url('uploads/'.$user->photo):base_url('assets/adminlte/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
								<p>
									<?php echo $user->full_name ?>
								</p>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="<?php echo base_url($this->router->fetch_class().'/profile') ?>" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<a href="<?php echo base_url($this->router->fetch_class().'/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->
					<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo (!empty($user->photo))?base_url('uploads/'.$user->photo):base_url('assets/adminlte/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" style="max-height: 45px;">
				</div>
				<div class="pull-left info">
					<p><?php echo $user->full_name ?></p>
					<!-- Status -->
					<a href="#"><i class="fa fa-circle text-success"></i> online</a>
				</div>
			</div>

			<!-- search form (Optional) -->
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>
			<!-- /.search form -->

			<!-- Sidebar Menu -->
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">MENU</li>
				<!-- Optionally, you can add icons to the links -->
				<li class="<?php echo $this->router->fetch_method() == 'index'?'active':'' ?>"><a href="<?php echo base_url($this->router->fetch_class()) ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
				<li><a href="<?php echo base_url($this->router->fetch_class().'/data_training') ?>"><i class="fa fa-link"></i> <span>Data Training</span></a></li>
			</ul>
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<?php echo $page ?>
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">Skripsi</a>.</strong> All rights reserved.
	</footer>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Create the tabs -->
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
			<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
			<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<!-- Home tab content -->
			<div class="tab-pane active" id="control-sidebar-home-tab">
				<h3 class="control-sidebar-heading">Recent Activity</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript:;">
							<i class="menu-icon fa fa-birthday-cake bg-red"></i>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
								<p>Will be 23 on April 24th</p>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

				<h3 class="control-sidebar-heading">Tasks Progress</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript:;">
							<h4 class="control-sidebar-subheading">
								Custom Template Design
								<span class="pull-right-container"><span class="label label-danger pull-right">70%</span></span>
							</h4>

							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

			</div>
			<!-- /.tab-pane -->
			<!-- Stats tab content -->
			<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
			<!-- /.tab-pane -->
			<!-- Settings tab content -->
			<div class="tab-pane" id="control-sidebar-settings-tab">
				<form method="post">
					<h3 class="control-sidebar-heading">General Settings</h3>
					<div class="form-group">
						<label class="control-sidebar-subheading">
							Report panel usage
							<input type="checkbox" class="pull-right" checked>
						</label>
						<p>Some information about this general settings option</p>
					</div>
					<!-- /.form-group -->
				</form>
			</div>
			<!-- /.tab-pane -->
		</div>
	</aside>
	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
	immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>

<!-- add sample -->
<div class="modal fade" id="modal-add-sample">
	<div class="modal-dialog">
		<form id="add-sample" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Sampel</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="title" class="form-control" placeholder="Nama Sampel">
						<span class="help-block error"></span>
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea class="form-control" name="description" placeholder="Deskripsi"></textarea>
						<span class="help-block error"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- edit sample -->
<div class="modal fade" id="modal-edit-sample">
	<div class="modal-dialog">
		<form id="edit-sample" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Sampel</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="title" class="form-control" placeholder="Nama Sampel">
						<span class="help-block error"></span>
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea class="form-control" name="description" placeholder="Deskripsi"></textarea>
						<span class="help-block error"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- add data -->
<div class="modal fade" id="modal-add-data">
	<div class="modal-dialog">
		<form id="add-sample-image">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Data Training</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<h3>Pilih Gambar</h3>
							<div class="form-group">
								<img class="hidden img-responsive" id="choosen-image">
							</div>
							<div class="form-group">
								<input type="file" accept="image/*" class="form-control" id="choose-image">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success btn-block hidden" id="upload-choosen-image">Unggah Gambar</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- view data -->
<div class="modal fade" id="modal-view-data">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Detail Data Training</h4>
			</div>
			<div class="modal-body" id="detail-data-training"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/adminlte/') ?>bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/adminlte/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- JQuery InputMask -->
<script src="<?php echo base_url('assets/adminlte/') ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url('assets/adminlte/') ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url('assets/adminlte/') ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- SweetAlert2 -->
<script src="<?php echo base_url('assets/plugins/') ?>SweetAlert2/dist/sweetalert2.all.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/') ?>DataTables/datatables.min.js"></script>

<script src="<?php echo base_url('assets/plugins/ColorThief/color-thief.js') ?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminlte/') ?>dist/js/adminlte.min.js"></script>

<script type="text/javascript">
function readURL(input, element) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$(element).attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

$('#choose-image').on('change', (event) => {
	if (event.target.files.length > 0)
	{
		// var image = URL.createObjectURL(event.target.files[0]);
		// $('#choosen-image').removeClass('hidden').attr('src', image);
		var data_id =  $($($('#add-sample-image')[0]).children('input')[0]).val();
		var label = $($($('#add-sample-image')[0]).children('input')[1]).val();

		var reader = new FileReader();
		reader.onload = function (e) {
			$('#choosen-image').removeClass('hidden').attr('src', e.target.result);
			// $('#upload-choosen-image').removeClass('hidden');

			var image_result = e.target.result;
			var image = new Image();
			var colorThief = new ColorThief();
			// var colorArray = colorThief.getPalette(image, 16);
			// console.log(colorArray)

			var colorArray = new Array();
			image.addEventListener('load', function() {
				colorArray = colorThief.getPalette(image, 16);
			});

			image.src = image_result;

			$.ajax({
				url: '<?php echo base_url($this->router->fetch_class().'/add_training_image/') ?>'+data_id,
				type: 'POST',
				dataType: 'JSON',
				data: {
					image: image_result
				},
				success: function(data) {
					$.ajax({
						url: '<?php echo base_url($this->router->fetch_class().'/add_training_data/') ?>'+data['data-training-image'],
						type: 'POST',
						dataType: 'JSON',
						data: {
							color: colorArray
						},
						success: function(data) {
							$('#choosen-image').addClass('hidden');
							$('#add-sample-image')[0].reset();
							Swal.fire('Selesai!', 'Data sudah diserap!', 'success');
						},
						error: function(error) {
							console.log(error)
						}
					});
				},
				error: function(error) {
					console.log(error)
				}
			});

		}

		reader.readAsDataURL(event.target.files[0]);
	}
	else
	{
		$('#choosen-image').addClass('hidden');
	}
});

function getFormData($form){
	var unindexed_array = $form.serializeArray();
	var indexed_array = {};

	$.map(unindexed_array, function(n, i){
		indexed_array[n['name']] = n['value'];
	});

	return indexed_array;
}

function validation_errors(form, data) {
	// reset form if data undefined
	if (data == undefined) {
		form[0].reset();
	}

	// show error on data
	$.each(form.find('.form-group'), function(index, el) {
		var child_element = $(el).children();
		$(child_element[2]).text('');
		if (data !== undefined) {
			Object.keys(data).forEach((el, index) => {
				if (el == $(child_element[1]).attr('name'))
				{
					$(child_element[2]).text(data[el]);
				}
			});
		}
	});
}

function fill_form(form, data) {
	$.each(form.find('.form-group'), function(index, el) {
		var child_element = $(el).children();
		if (data !== undefined) {
			Object.keys(data).forEach((el, index) => {
				if (el == $(child_element[1]).attr('name'))
				{
					$(child_element[1]).val(data[el]);
				}
			});
		}
	});
}

$('#add-sample').on('submit', function(event) {
	event.preventDefault();
	var _this_form = $(this);
	var data = getFormData(_this_form);
	$.ajax({
		url: '<?php echo base_url($this->router->fetch_class().'/add_training_name'); ?>',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		success: function(data) {
			if (data.saved) {
				validation_errors(_this_form);
				$('#modal-add-sample').modal('toggle');
				window.location.reload();
			} else {
				validation_errors(_this_form, data.data);
			}
		},
		error: function(error) {
			console.log(error)
		}
	});
});

$('#edit-sample').on('submit', function(event) {
	event.preventDefault();
	var _this_form = $(this);
	var data = getFormData(_this_form);
	$.ajax({
		url: '<?php echo base_url($this->router->fetch_class().'/update_training_name/'); ?>'+data.data_id,
		type: 'POST',
		dataType: 'JSON',
		data: data,
		success: function(data) {
			if (data.saved) {
				validation_errors(_this_form);
				$('#modal-edit-sample').modal('toggle');
				window.location.reload();
			} else {
				validation_errors(_this_form, data.data);
			}
		},
		error: function(error) {
			console.log(error);
		}
	});
});

$(document).on('click', '.btn-data-training-option', function(event) {
	event.preventDefault();
	var _this_btn = $(this);
	var _data_id = $(this).attr('data-id');
	var _data_option = $(this).attr('data-option');
	switch (_data_option) {
		case 'add':
			$.ajax({
				url: '<?php echo base_url($this->router->fetch_class().'/training_name'); ?>/'+_data_id,
				type: 'GET',
				dataType: 'JSON',
				success: function(data) {
					$('#modal-add-data').modal('toggle');
					if ($($('#add-sample-image')[0]).children('input').length == 0) {
						$($('#add-sample-image')[0]).prepend('<input type="hidden" name="data_label" value="'+data.title+'">');
						$($('#add-sample-image')[0]).prepend('<input type="hidden" name="data_id" value="'+data.id+'">');
					} else {
						$($($('#add-sample-image')[0]).children('input')[0]).val(data.id);
						$($($('#add-sample-image')[0]).children('input')[1]).val(data.title);
					}
				},
				error: function(error) {
					console.log(error)
				}
			});
		break;

		case 'view':
			$.ajax({
				url: '<?php echo base_url($this->router->fetch_class().'/all_data'); ?>/'+_data_id,
				type: 'GET',
				dataType: 'JSON',
				success: function(data) {
					var html = '<div class="col-lg-12">';

					for (i = 0; i < data.images.length; i++) {
						margin_top = 18;
						if (i == 0)
						{
							margin_top = 0;
						}
						html += '<img src="<?php echo base_url('uploads/') ?>'+data.images[i].file+'" class="img-responsive" style="margin-top:'+margin_top+'%; margin-bottom:2%">';
						for (icolor = 0; icolor < data.images[i].colors.length; icolor++) {
							html += '<div class="col-lg-1 palette" style="background-color: rgb('+data.images[i].colors[icolor].red+', '+data.images[i].colors[icolor].green+', '+data.images[i].colors[icolor].blue+'); height: 200px; width: 200px; float:left;"></div>'
						}
					}

					html += '</div>';
					$('#detail-data-training').html(html);
					$('#modal-view-data').modal('toggle');
				},
				error: function(error) {
					console.log(error)
				}
			});
		break;

		case 'edit':
			$.ajax({
				url: '<?php echo base_url($this->router->fetch_class().'/training_name'); ?>/'+_data_id,
				type: 'GET',
				dataType: 'JSON',
				success: function(data) {
					$('#modal-edit-sample').modal('toggle');
					if ($($('#edit-sample')[0]).children('input').length < 1) {
						$($('#edit-sample')[0]).prepend('<input type="hidden" name="data_id" value="'+_data_id+'">');
					} else {
						$($('#edit-sample')[0]).children('input').val(_data_id);
					}
					fill_form($('#edit-sample'), data);
				},
				error: function(error) {
					console.log(error);
				}
			});
		break;

		default :
			$.ajax({
				url: '<?php echo base_url($this->router->fetch_class().'/delete_training_name'); ?>/'+_data_id,
				type: 'GET',
				dataType: 'JSON',
				success: function(data) {
					_this_btn.parent().parent().remove();
				},
				error: function(error) {
					console.log(error);
				}
			});
		break;
	}
});

$('.datatable').DataTable({
	responsive: true
});
</script>
</body>
</html>
