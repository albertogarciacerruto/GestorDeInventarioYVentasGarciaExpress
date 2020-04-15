<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Garcia Express C.A.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ url('assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ url('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img style="height: 100px;" src="{{ url('images/logo.png') }}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li><a href="{{ url('users') }}"><i class="ti-map-alt"></i> <span>Usuarios del sistema</span></a></li>
                            <li><a href="{{ url('clients') }}"><i class="ti-receipt"></i> <span>Clientes</span></a></li> 
                            <li><a href="{{ url('providers') }}"><i class="ti-home"></i><span>Proveedores</span></a></li>  
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Productos</span></a>
                                <ul class="collapse">
                                    <li><a href="{{ url('products') }}">Repuestos</a></li>
                                    <li><a href="{{ url('services') }}">Servicios</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('inventories') }}"><i class="ti-layers-alt"></i><span>Inventario</span></a></li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Cotizaciones</span></a>
                                <ul class="collapse">
                                    <li><a href="{{ url('register_quotation') }}">Crear Cotización</a></li>
                                    <li><a href="{{ url('quotations') }}">Ver Cotizaciones</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>Facturas / Ventas</span></a>
                                <ul class="collapse">
                                    <li><a href="{{ url('orders') }}">Ver Ordenes</a></li>
                                    <li><a href="{{ url('orders_devolution') }}">Ver Devueltas</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-slice"></i><span>Configuraciones</span></a>
                                <ul class="collapse">
                                    <li><a href="{{ url('iva') }}">I.V.A</a></li>
                                    <li><a href="{{ url('locations') }}">Almacenes</a></li>
                                    <li><a href="{{ url('payments') }}">Formas de Pago</a></li>
                                    <li><a href="{{ url('dollars') }}">Valor del dolar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <?php 
                            $date = \Carbon\Carbon::now();
                            $date = $date->format('d-m-Y');
                            ?>
                            <h4 style="margin-top:6%">{{$date}}</h4>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end --> 
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Panel Administrativo</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right"> 
                        <?php $image = Auth::user()->image;?>
                            <img id="avatar" class="avatar user-thumb" src="{{ url('../storage/app/'.$image) }}" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} {{ Auth::user()->lastname }} <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('profile_edit', encrypt(Auth::user()->id)) }}"><i class="fa fa-cog"></i>  Editar Perfil</a>
                                <a class="dropdown-item" href="{{ url('profile_pass', encrypt(Auth::user()->id)) }}"><i class="fa fa-user"></i>  Cambiar Contraseña</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>  Cerrar Sesión</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                @yield('content')  
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright Automoviles García Express C.A. - 2020. Todos los derechos reservados. Creado por:<a href="https://www.linkedin.com/in/alberto-garcia-cerruto/"> Ing. Alberto Garcia Cerruto</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    
    <!-- jquery latest version -->
    <script src="{{ url('assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{ url('assets/js/line-chart.js') }}"></script>
    <!-- all pie chart -->
    <script src="{{ url('assets/js/pie-chart.js') }}"></script>
    <!-- others plugins -->
    <script src="{{ url('assets/js/plugins.js') }}"></script>
    <script src="{{ url('assets/js/scripts.js') }}"></script>

    <!-- jQuery -->
	<script language="javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<!-- El JavaScript de DataTables -->
	<script language="javascript" type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
	<!-- El JavaScript de BootStrap -->
	<script language="javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
	<!-- El código JavaScript -->
	<script language="javascript">
		var objetoDataTables_miembros = $('#DataTable').DataTable({
			"language": {
				"emptyTable":			"No hay datos disponibles en la tabla.",
				"info":		   		"Del _START_ al _END_ de _TOTAL_ ",
				"infoEmpty":			"Mostrando 0 registros de un total de 0.",
				"infoFiltered":			"(filtrados de un total de _MAX_ registros)",
				"infoPostFix":			"(actualizados)",
				"lengthMenu":			"Mostrar _MENU_ registros",
				"loadingRecords":		"Cargando...",
				"processing":			"Procesando...",
				"search":			"Buscar:",
				"searchPlaceholder":		"Dato para buscar",
				"zeroRecords":			"No se han encontrado coincidencias.",
				"paginate": {
					"first":			"Primera",
					"last":				"Última",
					"next":				"Siguiente",
					"previous":			"Anterior"
				},
				"aria": {
					"sortAscending":	"Ordenación ascendente",
					"sortDescending":	"Ordenación descendente"
				}
			},
		});
		$('label').addClass('form-inline');
		$('select, input[type="search"]').addClass('form-control input-sm');
    </script>
    
    <!-- El código JavaScript -->
	<script language="javascript">
		var objetoDataTables_miembros = $('#DataTableTwo').DataTable({
			"language": {
				"emptyTable":			"No hay datos disponibles en la tabla.",
				"info":		   		"Del _START_ al _END_ de _TOTAL_ ",
				"infoEmpty":			"Mostrando 0 registros de un total de 0.",
				"infoFiltered":			"(filtrados de un total de _MAX_ registros)",
				"infoPostFix":			"(actualizados)",
				"lengthMenu":			"Mostrar _MENU_ registros",
				"loadingRecords":		"Cargando...",
				"processing":			"Procesando...",
				"search":			"Buscar:",
				"searchPlaceholder":		"Dato para buscar",
				"zeroRecords":			"No se han encontrado coincidencias.",
				"paginate": {
					"first":			"Primera",
					"last":				"Última",
					"next":				"Siguiente",
					"previous":			"Anterior"
				},
				"aria": {
					"sortAscending":	"Ordenación ascendente",
					"sortDescending":	"Ordenación descendente"
				}
			},
		});
		$('label').addClass('form-inline');
		$('select, input[type="search"]').addClass('form-control input-sm');
	</script>

    <script type="text/javascript">

    $(".guardar").on("click", function () {
        var amount = $("#amount").val();
        var monto = amount.replace(/\,/g, "");
        var amountFinal = monto.replace(/\./g, ".");
        $("#amount").val(amountFinal);

    });

    $(document).ready(function () {
        $("#amount").on({
            "focus": function (event) {
                $(event.target).select();
            },
            "keyup": function (event) {
                $(event.target).val(function (index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
                console.log($("#amount").val());
            }
        });
    });


    //AQUI
    $(".save").on("click", function () {
        var value = $("#value").val();
        var valor = value.replace(/\,/g, "");
        var valorFinal = valor.replace(/\./g, ".");
        $("#value").val(valorFinal);

    });

    $(document).ready(function () {
        $("#value").on({
            "focus": function (event) {
                $(event.target).select();
            },
            "keyup": function (event) {
                $(event.target).val(function (index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
                console.log($("#value").val());
            }
        });
    });
    
    //AQUI FIN

    $(document).on('keyup', '.telefono', function (e) {
        var str = document.getElementById("phone").value;
        var final = str.replace(/[/*-.=;(),QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnmñÑ{['"_¨´+} ]/g, "");
        $("#phone").val(final).change();
    });

    $(document).on('blur', '.telefono', function (e) {
        var str = document.getElementById("phone").value;
        var final = str.replace(/[/*-.=;(),QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnmñÑ{['"_¨´+} ]?/g, "");
        $("#phone").val(final).change();
    });

    function init() {
    var inputFile = document.getElementById('image');
    inputFile.addEventListener('change', mostrarImagen, false);
    }

    function mostrarImagen(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(event) {
        var img = document.getElementById('photo');
        img.src= event.target.result;
    }
    reader.readAsDataURL(file);
    }

    window.addEventListener('load', init, false);

    </script>

    <style>
    .btn_cargar{
        display: inline-block;
        font-size: 15px;
        color: #fff;
        background: #815ef6;
        border-radius: 3px;
        text-transform: capitalize;
        font-family: 'Lato', sans-serif;
        letter-spacing: 0.03em;
    }
    .boton {
        padding: 0 0 !Important;
	    padding: 0 0 !Important;
    }
    .input {
		vertical-align: middle;
    }
    </style>

</body>

</html>
