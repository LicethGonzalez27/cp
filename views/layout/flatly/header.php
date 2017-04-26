<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php if(isset($this->titulo)) echo $this->titulo; ?></title>
    <meta name="description" content="Sistema de Información para Transporte Especial.">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="<?php echo $_layoutParams['ruta_img']; ?>logo/integer-soft32x32.png">
    <link rel="apple-touch-icon" href="<?php echo $_layoutParams['ruta_img']; ?>logo/integer57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="<?php echo $_layoutParams['ruta_img']; ?>logo/integer72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="<?php echo $_layoutParams['ruta_img']; ?>logo/integer76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="<?php echo $_layoutParams['ruta_img']; ?>logo/integer114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="<?php echo $_layoutParams['ruta_img']; ?>logo/integer120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="<?php echo $_layoutParams['ruta_img']; ?>logo/integer144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="<?php echo $_layoutParams['ruta_img']; ?>logo/Integer152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="<?php echo $_layoutParams['ruta_img']; ?>logo/Integer180.png" sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->

    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="<?php echo $_layoutParams['ruta_css']; ?>bootstrap.min.css">
    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="<?php echo $_layoutParams['ruta_css']; ?>plugins.css">
    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="<?php echo $_layoutParams['ruta_css']; ?>main.css">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
    <link rel="stylesheet" href="<?php echo $_layoutParams['ruta_css']; ?>themes/emerald.css">

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last)-->
    <link rel="stylesheet" href="<?php echo $_layoutParams['ruta_css']; ?>themes.css"> 
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) & Respond.js (enables responsive CSS code on browsers that don't support it, eg IE8) -->
    <link href="<?php echo $_layoutParams['ruta_css']; ?>estilos.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo $_layoutParams['ruta_js']; ?>vendor/modernizr-respond.min.js"></script>

    
    <!--<script src="<?php echo BASE_URL; ?>public/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>public/js/jquery.validate.js" type="text/javascript"></script>-->
    
    
    
    <!-- CSS personalizado para cada controlador -->
    <?php if(isset($_layoutParams['css']) && count($_layoutParams['css'])): ?>
        <?php for($i=0; $i < count($_layoutParams['css']); $i++): ?>
            <link rel="stylesheet" href="<?php echo $_layoutParams['css'][$i]; ?>">
        <?php endfor; ?>
    <?php endif; ?>
    <!-- Fin CSS personalizado  -->

</head>

<body>
    <input id="BASE_URL" name="BASE_URL" type="hidden" value="<?php echo BASE_URL; ?>" >
    <?php if ($_layoutParams['item'] == 'login'): ?>


    <?php else: ?>
    <div class="preloader themed-background">
        <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
        <div class="inner">
            <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
            <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
        </div>
    </div>
    <!-- Page Wrapper -->
    <!--
    Available classes:

    'page-loading'      enables page preloader
    -->
    <div id="page-wrapper" >
        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!--
        
        'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links
        -->
        <div id="page-container" class="sidebar-visible-lg sidebar-no-animations">
            <!-- Alternative Sidebar -->
            <div id="sidebar-alt">
                Alternative Sidebar Content
            </div>
            <!-- END Alternative Sidebar -->

            <!-- Main Sidebar -->
            <div id="sidebar">
               <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Brand -->
                        <a href="<?php echo BASE_URL; ?>" class="sidebar-brand">
                            <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong><?php echo APP_NAME; ?></strong>-APP</span>
                        </a>
                        <!-- END Brand -->

                        <!-- User Info -->
                        <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                            <div class="sidebar-user-avatar">
                                <a href="javascript:void(0)">
                                    <img src="<?php echo $_layoutParams['ruta_img']; ?>placeholders/avatars/avatar2.jpg.png" alt="avatar">
                                </a>
                            </div>
                            <div class="sidebar-user-name"><?php echo Session::get('nombre_usuario'); ?></div>
                            <div class="sidebar-user-links">
                                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Perfil"><i class="gi gi-user"></i></a>
                                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Mensajes"><i class="gi gi-envelope"></i></a>
                                <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                                <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Configuración" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                                <a href="<?php echo BASE_URL; ?>login/cerrar" data-toggle="tooltip" data-placement="bottom" title="Cerrar sesión"><i class="gi gi-exit"></i></a>
                            </div>
                        </div>
                        <!-- END User Info -->

                        <!-- Sidebar Navigation -->
                        <ul class="sidebar-nav">
                            <li>
                                <a href="<?php echo BASE_URL; ?>" class="active"><i class="gi gi-leaf sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Inicio</span></a>
                            </li>
                            <li>
                                <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-notes_2 sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Planillas</span></a>
                                <ul>
                                    <li>
                                        <a href="<?php echo BASE_URL; ?>planilla">Generar</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL; ?>pasajeros">Pasajeros</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Estadisticas</span></a>
                                <ul>
                                    <li>
                                        <a href="<?php echo BASE_URL; ?>">--</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-header">
                                <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Quick Settings"><i class="gi gi-settings"></i></a><a href="javascript:void(0)" data-toggle="tooltip" title="Create the most amazing pages with the widget kit!"><i class="gi gi-lightbulb"></i></a></span>
                                <span class="sidebar-header-title">Parque Automotor</span>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL; ?>automotor"><i class="gi gi-car sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Vehículos</span></a>
                            </li>
                            <li>
                                <a id="a_t_operacion" href="<?php echo BASE_URL; ?>tarjeta_operacion"><i class="gi gi-credit_card sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Tarj. de Operación </span></a>
                            </li>
                            <li>
                                <a id="a_soat" href="<?php echo BASE_URL; ?>seguros"><i class="gi gi-hospital sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Seguros </span></a>
                            </li>
                            <li>
                                <a id="a_tecnomecanica" href="<?php echo BASE_URL; ?>tecnomecanica"><i class="hi hi-wrench sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Rev. Tecnomecánica </span></a>
                            </li>
                            <li class="sidebar-header">
                                <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Quick Settings"><i class="gi gi-settings"></i></a></span>
                                <span class="sidebar-header-title">Empresa </span>
                            </li>
                            <li>
                                <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-certificate sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Usuarios</span></a>
                                <ul>
                                    <li>
                                        <a href="<?php echo BASE_URL; ?>empleados">General </a>
                                    </li>
                                </ul>
                            </li>
                            <li> 
                                <a id="a_conductores" href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-notes_2 sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Conductores </span> </a>
                                <ul>
                                    <li>
                                        <a href="<?php echo BASE_URL; ?>empleados">General </a>
                                    </li>
                                    <li>
                                        <a id="a_licencia" href="<?php echo BASE_URL; ?>empleados">Licencias </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- END Sidebar Navigation -->

                        <!-- Sidebar Notifications -->
                            <!--
                        <div class="sidebar-header sidebar-nav-mini-hide">
                            <span class="sidebar-header-options clearfix">
                                <a href="javascript:void(0)" data-toggle="tooltip" title="Refresh"><i class="gi gi-refresh"></i></a>
                            </span>
                            <span class="sidebar-header-title">Activity</span>
                        </div>
                        <div class="sidebar-section sidebar-nav-mini-hide">
                            <div class="alert alert-success alert-alt">
                                <small>5 min ago</small><br>
                                <i class="fa fa-thumbs-up fa-fw"></i> You had a new sale ($10)
                            </div>
                            <div class="alert alert-info alert-alt">
                                <small>10 min ago</small><br>
                                <i class="fa fa-arrow-up fa-fw"></i> Upgraded to Pro plan
                            </div>
                            <div class="alert alert-warning alert-alt">
                                <small>3 hours ago</small><br>
                                <i class="fa fa-exclamation fa-fw"></i> Running low on space<br><strong>18GB in use</strong> 2GB left
                            </div>
                            <div class="alert alert-danger alert-alt">
                                <small>Yesterday</small><br>
                                <i class="fa fa-bug fa-fw"></i> <a href="javascript:void(0)"><strong>New bug submitted</strong></a>
                            </div>
                        </div> -->
                        <!-- END Sidebar Notifications -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">
                <!-- Header -->
                <!-- In the PHP version you can set the following options from inc/config file -->
                <!--
                Available header.navbar classes:

                'navbar-default'            for the default light header
                'navbar-inverse'            for an alternative dark header

                'navbar-fixed-top'          for a top fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
                    'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

                'navbar-fixed-bottom'       for a bottom fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
                    'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
                -->
                <header class="navbar navbar-default">
                    <!-- Left Header Navigation -->
                    <ul class="nav navbar-nav-custom">
                        <!-- Main Sidebar Toggle Button -->
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                <i class="fa fa-bars fa-fw"></i>
                            </a>
                        </li>
                        <!-- END Main Sidebar Toggle Button -->

                        <!-- Template Options -->
                        <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="gi gi-settings"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-options">
                                <li class="dropdown-header text-center">Estilo de encabezado</li>
                                <li>
                                    <div class="btn-group btn-group-justified btn-group-sm">
                                        <a href="javascript:void(0)" class="btn btn-primary" id="options-header-default">Light</a>
                                        <a href="javascript:void(0)" class="btn btn-primary" id="options-header-inverse">Dark</a>
                                    </div>
                                </li>
                                <li class="dropdown-header text-center">Estilo de página</li>
                                <li>
                                    <div class="btn-group btn-group-justified btn-group-sm">
                                        <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style">Default</a>
                                        <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style-alt">Alternative</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- END Template Options -->
                    </ul>
                    <!-- END Left Header Navigation -->

                    <!-- Search Form -->
                    <form action="page_ready_search_results.html" method="post" class="navbar-form-custom" role="search">
                        <div class="form-group">
                            <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Buscar..">
                        </div>
                    </form>
                    <!-- END Search Form -->

                    <!-- Right Header Navigation -->
                    <ul class="nav navbar-nav-custom pull-right">
                        <!-- Alternative Sidebar Toggle Button -->
                        <li>
                            <!-- If you do not want the main sidebar to open when the alternative sidebar is closed, just remove the second parameter: App.sidebar('toggle-sidebar-alt'); -->
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt', 'toggle-other');this.blur();">
                                <i class="gi gi-share_alt"></i>
                                <span class="label label-primary label-indicator animation-floating">4</span>
                            </a>
                        </li>
                        <!-- END Alternative Sidebar Toggle Button -->

                        <!-- User Dropdown -->
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo $_layoutParams['ruta_img']; ?>placeholders/avatars/avatar2.jpg.png" alt="avatar"> <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Cuenta</li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-clock-o fa-fw pull-right"></i>
                                        <span class="badge pull-right">10</span>
                                        Actualizaciones
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-envelope-o fa-fw pull-right"></i>
                                        <span class="badge pull-right">5</span>
                                        Mensajes
                                    </a>
                                    <a href="javascript:void(0)"><i class="fa fa-magnet fa-fw pull-right"></i>
                                        <span class="badge pull-right">3</span>
                                        Suscripciones
                                    </a>
                                    <a href="javascript:void(0)"><i class="fa fa-question fa-fw pull-right"></i>
                                        <span class="badge pull-right">11</span>
                                        FAQ
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-user fa-fw pull-right"></i>
                                        Perfil
                                    </a>
                                    <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                                    <a href="#modal-user-settings" data-toggle="modal">
                                        <i class="fa fa-cog fa-fw pull-right"></i>
                                        Configuración
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fa fa-lock fa-fw pull-right"></i> Bloquear</a>
                                    <a href="<?php echo BASE_URL; ?>login/cerrar"><i class="fa fa-ban fa-fw pull-right"></i> Cerrar Sesión</a>
                                </li>
                                <li class="dropdown-header text-center">Actividades</li>
                                <li>
                                    <div class="alert alert-success alert-alt">
                                        <small>5 min ago</small><br>
                                        <i class="fa fa-thumbs-up fa-fw"></i> You had a new sale ($10)
                                    </div>
                                    <div class="alert alert-info alert-alt">
                                        <small>10 min ago</small><br>
                                        <i class="fa fa-arrow-up fa-fw"></i> Upgraded to Pro plan
                                    </div>
                                    <div class="alert alert-warning alert-alt">
                                        <small>3 hours ago</small><br>
                                        <i class="fa fa-exclamation fa-fw"></i> Running low on space<br><strong>18GB in use</strong> 2GB left
                                    </div>
                                    <div class="alert alert-danger alert-alt">
                                        <small>Yesterday</small><br>
                                        <i class="fa fa-bug fa-fw"></i> <a href="javascript:void(0)" class="alert-link">New bug submitted</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- END User Dropdown -->
                    </ul>
                    <!-- END Right Header Navigation -->
                </header>
                <!-- END Header -->

                <!-- Page Content -->
                <div id="page-content">
                    <!-- Dashboard Header -->
                    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
                    <?php if ($_layoutParams['item'] == 'index'): ?>
                    <div class="content-header content-header-media">
                        <div class="header-section">
                            <div class="row">                         

                                    <!-- Main Title (hidden on small devices for the statistics to fit) -->
                                    <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                                        <h1>Bienvenido <strong><?php echo Session::get('nombre_usuario'); ?></strong><br><small><?php if(isset($this->descripcion)) echo $this->descripcion; ?></small></h1>
                                    </div>
                                    <!-- END Main Title -->

                                <!-- Top Stats -->
                                <div class="col-md-8 col-lg-6">
                                    <div class="row text-center">
                                        <div class="col-xs-4 col-sm-3">
                                            <h2 class="animation-hatch">
                                                <strong><?php echo $this->estadisticas['planillas']; ?></strong><br>
                                                <small><i class="hi hi-list-alt"></i> Contratos</small>
                                            </h2>
                                        </div>
                                        <div class="col-xs-4 col-sm-3">
                                            <h2 class="animation-hatch">
                                                <strong><?php echo $this->estadisticas['pasajeros']; ?></strong><br>
                                                <small><i class="gi gi-parents"></i> Pasajeros</small>
                                            </h2>
                                        </div>
                                        <div class="col-xs-4 col-sm-3">
                                            <h2 class="animation-hatch">
                                                <strong><?php echo $this->estadisticas['planillasHoy']; ?></strong><br>
                                                <small><i class="gi gi-road"></i>  Hoy</small>
                                            </h2>
                                        </div>
                                        <!-- We hide the last stat to fit the other 3 on small devices -->
                                        <div class="col-sm-3 hidden-xs">
                                            <h2 class="animation-hatch">
                                                <strong><?php echo $this->estadisticas['automotoresTrabajando']; ?></strong><br>
                                                <small><i class="gi gi-car"></i> Disp.</small>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Top Stats -->
                            </div>
                        </div>
                        <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
                        <img src="<?php echo $_layoutParams['ruta_img']; ?>placeholders/headers/dashboard_header.jpg" alt="header image" class="animation-pulseSlow">
                    </div>
                    <?php else: ?>
                        <!-- Statistics Widgets Header -->
                        <div class="content-header">
                            <div class="header-section">
                                <h1>
                                    <i class="<?php if(isset($this->icono)) echo $this->icono; ?>"></i><?php echo $this->titulo; ?><br><small><?php if(isset($this->descripcion)) echo $this->descripcion; ?></small>
                                </h1>
                            </div>
                        </div>
                        <!--
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i></a></li>
                            <?php if ($_layoutParams['navegacion']['metodo'] == 'index'): ?>
                                <li><?php echo $this->titulo; ?></li>
                            <?php else: ?>
                                <li><a href="<?php echo $_layoutParams['navegacion']['ruta'] ?>"><?php echo $_layoutParams['navegacion']['controlador'] ?></a></li>
                                <li><?php echo $this->titulo; ?></li>
                            <?php endif ?>
                        </ul>-->
                        <!-- END Statistics Widgets Header -->
                    <?php endif ?>
                    <!-- END Dashboard Header -->

    <?php endif; ?>

    <noscript><p>Para el correcto funcionamiento debe tener el soporte de javascript habilitado</p></noscript>
                            
    <?php if(isset($this->_error)): ?>
    <div id="error" class="alert alert-danger" role="alert"><?php echo $this->_error; ?></div>
    <?php endif; ?>

     <?php if(isset($this->_mensaje)): ?>
    <div id="mensaje" class="alert alert-success" role="alert"><?php echo $this->_mensaje; ?></div>
    <?php endif; ?>            




        