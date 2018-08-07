<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>SGE_CLE</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="favicon.ico">

        <!--Google Font link-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


        <link rel="stylesheet" href="css/slick/slick.css"> 
        <link rel="stylesheet" href="css/slick/slick-theme.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/iconfont.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/bootsnav.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">

        <!-- xsslider slider css -->


        <!--<link rel="stylesheet" href="css/xsslider.css">-->

        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="css/plugins.css" />-->

        <!--Theme custom css -->
        <link rel="stylesheet" href="css/style.css">
        <!--<link rel="stylesheet" href="css/colors/maron.css">-->

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="css/responsive.css" />

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse">

        <!-- Preloader -->
        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div>
                </div>
            </div>
        </div><!--End off Preloader -->


        <div class="culmn">
            <!--Home page style-->


            <nav class="navbar navbar-default bootsnav navbar-fixed">
                <div class="navbar-top bg-grey fix">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="navbar-callus text-left sm-text-center">
                                    <ul class="list-inline">
                                        <li>Llámanos: 123456</i></li>
                                        <li><a href="mailto:direccion@lizardi.edu.mx?Subject=Informes" target="_top">Contáctanos: direccion@lizardi.edu.mx</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="navbar-socail text-right sm-text-center">
                                    <ul class="list-inline">
                                        <li><a href="http://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                        <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href=""><i class="fa fa-behance"></i></a></li>
                                        <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Top Search -->
                <!--div class="top-search">
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div-->
                <!-- End Top Search -->


                <div class="container"> 
                    <!--<div class="attr-nav">
                        <ul>
                            <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        </ul>
                    </div> -->

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="{{ route('inicio') }}">
                            <img src="images/logo.png" class="logo" alt="Colegio Fernández de Lizardi" width="70px" height="50px">
                            <!--<img src="images/footer-logo.png" class="logo logo-scrolled" alt="">-->
                        </a>

                    </div>
                    <!-- End Header Navigation -->

                    <!-- navbar menu -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#home">Inicio</a></li>                    
                            <li><a href="#features">Oferta Educativa</a></li>
                            <li><a href="#business">Talleres</a></li>
                            <li><a href="#product">Instalaciones</a></li>
                            <li><a href="#test">Horario Extendido</a></li>
                            <li><a href="#brand">Convenios</a></li>
                            <li><a href="#contact">Encuéntranos</a></li>
                            <!--li><a href="#contact">Contacto</a></li-->
                            <li><a id="demo01" href="#animatedModal">Contacto</a></li>
                            <li><a href={{ route('login') }}>Ingresar</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    @if (session('info'))
                        <strong>
                            <div class="alert alert-success alert-dismissable fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('info') }}
                            </div>
                        </strong>
                    @endif
                </div> 
            </nav>
            
            @yield('contenido')

            <footer id="contact" class="footer action-lage bg-black p-top-80">
                <!--<div class="action-lage"></div>-->
                <!--Call your modal-->
    

    <!--DEMO01-->
                <div class="container">
                    <div class="row">
                        <div class="widget_area">
                            <div class="col-md-3">
                                <div class="widget_item widget_about">
                                    <h5 class="text-white">Acerca de Nosotros</h5>
                                    <p class="m-top-20">Somos una institución educativa con más de 25 años de experiencia.</p>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-location-arrow"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-white">Dirección</h6>
                                            <p>
                                                Calle 30 de Julio #123. Col. Nueva Valladolid</p>
                                        </div>
                                    </div>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-phone"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-white">Teléfono :</h6>
                                            <p>+1 2345 6789</p>
                                        </div>
                                    </div>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-envelope-o"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-white">Correo Electrónico :</h6>
                                            <p>direccion@lizardi.edu.mx</p>
                                        </div>
                                    </div>
                                </div><!--End off widget item -->
                            </div><!-- End off col-md-3 -->

                            <div class="col-md-3">
                                <div class="widget_item widget_latest sm-m-top-50">
                                    <h5 class="text-white">Noticias Relevantes</h5>
                                    <div class="widget_latst_item m-top-30">
                                        <div class="item_icon"><img src="images/ltst-img-1.jpg" alt="" /></div>
                                        <div class="widget_latst_item_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                            <a href="">21<sup>th</sup> July 2016</a>
                                        </div>
                                    </div>
                                    <div class="widget_latst_item m-top-30">
                                        <div class="item_icon"><img src="images/ltst-img-2.jpg" alt="" /></div>
                                        <div class="widget_latst_item_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                            <a href="">21<sup>th</sup> July 2016</a>
                                        </div>
                                    </div>
                                    <div class="widget_latst_item m-top-30">
                                        <div class="item_icon"><img src="images/ltst-img-3.jpg" alt="" /></div>
                                        <div class="widget_latst_item_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                            <a href="">21<sup>th</sup> July 2016</a>
                                        </div>
                                    </div>
                                </div><!-- End off widget item-->
                            </div><!--End off col-md-3 -->

                            <div class="col-md-3">
                                <div class="widget_item widget_service sm-m-top-50">
                                    <h5 class="text-white">Latest News</h5>
                                    <ul class="m-top-20">
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> Web Design</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> User Interface Design</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> E- Commerce</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> Web Hosting</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> Themes</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> Support Forums</a></li>
                                    </ul>
                                </div><!-- End off widget item -->
                            </div><!-- End off col-md-3 -->

                            <div class="col-md-3">
                                <div class="widget_item widget_newsletter sm-m-top-50">
                                    <h5 class="text-white">Newsletter</h5>
                                    <form class="form-inline m-top-30">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Enter you Email">
                                            <button type="submit" class="btn text-center"><i class="fa fa-arrow-right"></i></button>
                                        </div>

                                    </form>
                                    <div class="widget_brand m-top-40">
                                        <a href="" class="text-uppercase">Your Logo</a>
                                        <p>Lorem ipsum dolor sit amet consec tetur 
                                            adipiscing elit nulla aliquet pretium nisi in</p>
                                    </div>
                                    <ul class="list-inline m-top-20">
                                        <li>-  <a href=""><i class="fa fa-facebook"></i></a></li>
                                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                        <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href=""><i class="fa fa-behance"></i></a></li>
                                        <li><a href=""><i class="fa fa-dribbble"></i></a>  - </li>
                                    </ul>

                                </div><!--End off widget item-->
                            </div><!--End off col-md-3 -->
                        </div>
                    </div>
                </div>
                <div class="main_footer fix bg-mega text-center p-top-40 p-bottom-30 m-top-80">
                    <div class="col-md-12">
                        <p class="wow fadeInRight" data-wow-duration="1s">
                            Desarrollado por: MGTI José Manuel Cuin Jacuinde. 2018. Interfaz de 
                            <a target="_blank" href="https://bootstrapthemes.co">Bootstrap Themes</a>.
                            2016. All Rights Reserved
                        </p>
                    </div>
                </div>
            </footer>




        </div>

        <!-- JS includes -->

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="css/slick/slick.js"></script>
        <script src="css/slick/slick.min.js"></script>
        <script src="js/jquery.collapse.js"></script>
        <script src="js/bootsnav.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        
        <script src="js/animatedModal.min.js"></script>
        <script>
            $("#demo01").animatedModal();
        </script>
        <style type="text/css">
            .btn-primary{
                background-color: #20193D !important;
            }
            #animatedModal{
                margin: auto !important;
            }
            .close-animatedModal{
                cursor: pointer;
            }
            .modal-content{
                width: 50% !important;
                margin: auto !important;
            }
            .modal-content2{
                width: 80% !important;
                margin: auto !important;
            }
            .buttonHolder{ 
                text-align: center; 
            }
        </style>
    </body>
</html>
