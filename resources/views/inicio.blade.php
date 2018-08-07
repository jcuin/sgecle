@extends('menu')


@section('contenido')
<!--Home Sections-->
<!DOCTYPE html>
<head>
    <title></title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
</head>

<body>
    <div id="animatedModal">
        <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
       
        <div class="modal-content">
            <div class="buttonHolder"> 
                <img src="images/logo.png" class="logo" alt="Colegio Fernández de Lizardi" width="90px" height="50px">
            </div>
            <h3 style="text-align: center;">Para el Colegio Fernández de Lizardi será un placer atenderte.<br>Déjanos tus datos y en breve nos pondremos en contacto contigo.</h3>
            <form method="POST" action="{{ route('storeInforme') }}" >
                {!! csrf_field() !!}
                <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" class="form-control" id="nombre" required="required" style="height: 40px !important;">
                {{ $errors -> first('nombre') }}<br>
                <input type="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" class="form-control" id="email" style="height: 40px !important;">
                {{ $errors -> first('email') }}<br>
                <input type="text" name="telefono" placeholder="Teléfono de Contacto" value="{{ old('telefono') }}" class="form-control" id="telefono" style="height: 40px !important;">
                {{ $errors -> first('telefono') }}<br>
                <input type="text" name="asunto" placeholder="Asunto" value="{{ old('asunto') }}" class="form-control" id="asunto" required="required" style="height: 40px !important;">
                {{ $errors -> first('asunto') }}<br>
                <label for="id_escolaridad">
                    Área de Atención<br>
                    <select name="id_escolaridad" id="id_escolaridad" class="form-control" style="height: 40px !important;">
                            @foreach($escolaridades as $escolaridad)
                               <option value="{{ $escolaridad -> id_escolaridad }}" @if(old('id_escolaridad') == $escolaridad -> id_escolaridad ) selected @endif>{{ $escolaridad -> escolaridad}}
                                </option>   
                            @endforeach
                    </select>
                    {{ $errors -> first('id_escolaridad') }}<br>
                </label>
                <label for="enterado">
                    ¿Cómo te enteraste de nosotros?
                    <select name="enterado" id="enterado" class="form-control" style="height: 40px !important;">
                        <option value="Recomendacion">Recomendación Personal</option>
                        <option value="Internet">Internet</option>
                        <option value="Redes_Sociales">Redes Sociales</option>
                        <option value="Radio_TV">Radio/TV</option>
                        <option value="Instalaciones">Al Ver Las Instalaciones</option>
                        <option value="Otro">Otro</option>
                    </select><br>
                    {{ $errors -> first('enterado') }}
                </label>
                <textarea name="mensaje" placeholder="Capture aquí sus preguntas" cols="50" rows="4" class="form-control" id="mensaje" required="required">{{ old('mensaje') }}</textarea>
                {{ $errors -> first('mensaje') }}<br>
                <div class="buttonHolder">    
                    <button type="submit" class="btn btn-primary">Enviar <i class="fa fa-paper-plane-o ml-2"></i></button>
                    <button type="reset" class="btn btn-primary close-animatedModal">Cancelar</button>
                </div>
            </form>        
        </div>
    </div>
            <section id="home" class="home bg-black fix" style="background: url({{ Storage::url($pagina -> banner_principal_imagen) }}) no-repeat scroll  center center; background-size: cover; position: relative;  padding-top: 300px; padding-bottom: 190px; width:100%;">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row"> 
                        <div class="main_home text-center">
                            <div class="col-md-12">
                                <div class="hello_slid">
                                    @for($i = 1; $i < count($banner_principal_texto); $i++)
                                        <div class="slid_item">
                                            <div class="home_text ">
                                                <h2 class="text-white"><strong>{{ $banner_principal_texto[$i] }}</strong></h2>
                                                <h1 class="text-white">Construyendo Realidades</h1>
                                                <h3 class="text-white"><strong>Colegio Fernández de Lizardi</strong></h3>
                                            </div>

                                            <div class="home_btns m-top-40">
                                                <a id="demo02" href="#animatedModal" class="btn btn-default m-top-20 demo02" style="background-color: #20193D !important;">Solicita informes</a>
                                            </div>
                                        </div><!-- End off slid item -->
                                    @endfor
                                    <!--<div class="slid_item">
                                        <div class="home_text ">
                                            <h2 class="text-white">Sembrando Sueños<strong></strong></h2>
                                            <h1 class="text-white">Construyendo Realidades</h1>
                                            <h3 class="text-white"><strong>Colegio Fernández de Lizardi</strong></h3>
                                        </div>

                                        <div class="home_btns m-top-40">
                                            <a href="" class="btn btn-primary m-top-20">Solicita informes</a>
                                        </div>
                                    </div--><!-- End off slid item -->
                                    <!--div class="slid_item">
                                        <div class="home_text ">
                                            <h2 class="text-white">Sembrando Sueños<strong></strong></h2>
                                            <h1 class="text-white">Construyendo Realidades</h1>
                                            <h3 class="text-white"><strong>Colegio Fernández de Lizardi</strong></h3>
                                        </div>

                                        <div class="home_btns m-top-40">
                                            <a href="" class="btn btn-primary m-top-20">Solicita informes</a>
                                            <a href="" class="btn btn-default m-top-20">Visítanos</a>
                                        </div>
                                    </div--><!-- End off slid item -->
                                </div>
                            </div>

                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Home Sections-->
            <?php
                $iteraciones = 0;
                $iteraciones = ceil(count($pagina_oferta)/3);   
                echo count($pagina_oferta);
                $oferta_por_iteracion = 3;
                $total_iteraciones = 0;
                echo $iteraciones;
            ?>
            <!--Featured Section-->
            <section id="features" class="features">
                @for($i = 0; $i < $iteraciones; $i++)
                    <div class="container">
                        <div class="row">
                            <div class="main_features fix roomy-70">
                                <?php $control_interno = 0; ?>
                                @for($j = $total_iteraciones; $j < count($pagina_oferta); $j++)
                                    <div class="col-md-4">               
                                        <div class="features_item sm-m-top-30">
                                            <div class="f_item_icon">
                                                <img src="{{ Storage::url($pagina_oferta[$j] -> oferta_imagen) }}"/>
                                            </div>
                                            <div class="f_item_text">
                                                <h3>{{ $pagina_oferta[$j] -> oferta_titulo }}</h3>
                                                <p>{{ $pagina_oferta[$j] -> oferta_texto }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $control_interno++;?>
                                    @if($control_interno == $oferta_por_iteracion)
                                       <?php
                                       break; ?>
                                    @endif
                                    <?php $total_iteraciones++; ?>
                                @endfor
                                <?php
                                $total_iteraciones++; 
                                ?>
                                <!--<div class="col-md-4">
                                    <div class="features_item sm-m-top-30">
                                        <div class="f_item_icon">
                                            <i class="fa fa-tablet"></i>
                                        </div>
                                        <div class="f_item_text">
                                            <h3>Responsive Design</h3>
                                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque eleifend
                                                in sit amet mattis volutpat rhoncus.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="features_item sm-m-top-30">
                                        <div class="f_item_icon">
                                            <i class="fa fa-sliders"></i>
                                        </div>
                                        <div class="f_item_text">
                                            <h3>Easy to Customize</h3>
                                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque eleifend
                                                in sit amet mattis volutpat rhoncus.</p>
                                        </div>
                                    </div>
                                </div-->
                            </div>
                        </div><!-- End off row -->
                    </div><!-- End off container -->
                @endfor
            </section><!-- End off Featured Section-->


            <!--Business Section-->
            <section id="business" class="business bg-grey roomy-70">
                <div class="container">
                    <div class="row">
                        <div class="main_business">
                            <div class="col-md-6">
                                <div class="business_slid">
                                    <div class="slid_shap bg-grey"></div>
                                    <div class="business_items text-center">
                                        
                                        @foreach($pagina_talleres as $pagina_taller)
                                            <div class="business_item">
                                                <div class="business_img">
                                                    <img src="{{ Storage::url($pagina_taller -> talleres_imagen) }}" alt="" />
                                                </div>
                                            </div>
                                        @endforeach
                                        <!--div class="business_item">
                                            <div class="business_img">
                                                <img src="images/about-img1.jpg" alt="" />
                                            </div>
                                        </div>

                                        <div class="business_item">
                                            <div class="business_img">
                                                <img src="images/about-img1.jpg" alt="" />
                                            </div>
                                        </div-->
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="business_item sm-m-top-50">
                                    <h2 class="text-uppercase"><strong>{{ $pagina -> taller_encabezado }}</strong></h2>
                                    <ul>
                                        @foreach($pagina_talleres as $pagina_taller)
                                            <li><i class="fa fa-arrow-circle-right"></i> {{ $pagina_taller -> talleres_titulo }}: {{ $pagina_taller -> talleres_texto }}</li>
                                        @endforeach
                                        <!--li><i class="fa  fa-arrow-circle-right"></i> Fully Responsive</li>
                                        <li><i class="fa  fa-arrow-circle-right"></i> Google Fonts</li-->
                                    </ul>
                                    <!--<p class="m-top-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit pellentesque eleifend in mi 
                                        sit amet mattis suspendisse ac ligula volutpat nisl rhoncus sagittis cras suscipit 
                                        lacus quis erat malesuada lobortis eiam dui magna volutpat commodo eget pretium vitae
                                        elit etiam luctus risus urna in malesuada ante convallis.</p>

                                    <div class="business_btn">
                                        <a href="https://bootstrapthemes.co" class="btn btn-default m-top-20">Read More</a>
                                        <a href="" class="btn btn-primary m-top-20">Buy Now</a>
                                    </div>-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End off Business section -->


            <!--product section-->
            <section id="product" class="product">
                <div class="container">
                    <div class="main_product roomy-80">
                        <div class="head_title text-center fix">
                            <h2 class="text-uppercase">{{ $pagina -> instalaciones_titulo }}</h2>
                            <h5>{{ $pagina -> instalaciones_texto }}</h5>
                        </div>

                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="container">
                                        <div class="row">
                                            @foreach($pagina_instalaciones as $pagina_instalacion)
                                                <div class="col-sm-3">
                                                    <div class="port_item xs-m-top-30">
                                                        <div class="port_img">
                                                            <img src="{{ Storage::url($pagina_instalacion -> instalaciones_imagen) }}" alt="" />
                                                            <div class="port_overlay text-center">
                                                                <a href="{{ Storage::url($pagina_instalacion -> instalaciones_imagen) }}" class="popup-img">+</a>
                                                            </div>
                                                        </div>
                                                        <div class="port_caption m-top-20">
                                                            <h5>{{ $pagina_instalacion -> instalaciones_titulo_imagen }}</h5>
                                                            <h6>{{ $pagina_instalacion -> instalaciones_texto_imagen }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!--div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img2.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img2.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img3.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img3.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img4.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img4.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div-->
                                        </div>
                                    </div>
                                </div>

                                <!--div class="item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img1.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img1.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img2.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img2.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img3.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img3.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img4.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img4.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img1.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img1.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img2.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img2.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img3.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img3.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="images/work-img4.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="images/work-img4.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div-->

                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                <span class="sr-only">Previous</span>
                            </a>

                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div><!-- End off row -->
                </div><!-- End off container -->
            </section><!-- End off Product section -->



            <!--Test section-->
            <section id="test" class="test bg-grey roomy-60 fix">
                <div class="container">
                    <div class="row">                        
                        <div class="main_test fix">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="head_title text-center fix">
                                    <h2 class="text-uppercase">{{ $pagina -> horario_titulo }}</h2>
                                    <h5>{{ $pagina -> horario_texto }}</h5>
                                </div>
                            </div>

                            @foreach($pagina_horarios as $pagina_horario)
                                <div class="col-md-6">
                                        <div class="test_item fix">
                                            <div class="item_img">
                                                <img class="img-circle" src="{{ Storage::url($pagina_horario -> horario_imagen) }}" alt="" />
                                                <i class="fa fa-quote-left"></i>
                                            </div>

                                            <div class="item_text">
                                                <h5>{{ $pagina_horario -> horario_titulo_imagen }}</h5>

                                                <p>{{ $pagina_horario -> horario_texto_imagen }}</p>
                                            </div>
                                        </div>
                                </div>
                            @endforeach

                            <!--div class="col-md-6">
                                <div class="test_item fix">
                                    <div class="item_img">
                                        <img class="img-circle" src="images/test-img1.jpg" alt="" />
                                        <i class="fa fa-quote-left"></i>
                                    </div>

                                    <div class="item_text">
                                        <h5>Sarah Smith</h5>
                                        <h6>envato.com</h6>

                                        <p>Natus voluptatum enim quod necessitatibus quis
                                            expedita harum provident eos obcaecati id culpa
                                            corporis molestias.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="test_item fix">
                                    <div class="item_img">
                                        <img class="img-circle" src="images/test-img1.jpg" alt="" />
                                        <i class="fa fa-quote-left"></i>
                                    </div>

                                    <div class="item_text">
                                        <h5>Sarah Smith</h5>
                                        <h6>envato.com</h6>

                                        <p>Natus voluptatum enim quod necessitatibus quis
                                            expedita harum provident eos obcaecati id culpa
                                            corporis molestias.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="test_item fix">
                                    <div class="item_img">
                                        <img class="img-circle" src="images/test-img1.jpg" alt="" />
                                        <i class="fa fa-quote-left"></i>
                                    </div>

                                    <div class="item_text">
                                        <h5>Sarah Smith</h5>
                                        <h6>envato.com</h6>

                                        <p>Natus voluptatum enim quod necessitatibus quis
                                            expedita harum provident eos obcaecati id culpa
                                            corporis molestias.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="test_item fix">
                                    <div class="item_img">
                                        <img class="img-circle" src="images/test-img1.jpg" alt="" />
                                        <i class="fa fa-quote-left"></i>
                                    </div>

                                    <div class="item_text">
                                        <h5>Sarah Smith</h5>
                                        <h6>envato.com</h6>

                                        <p>Natus voluptatum enim quod necessitatibus quis
                                            expedita harum provident eos obcaecati id culpa
                                            corporis molestias.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="test_item fix sm-m-top-30">
                                    <div class="item_img">
                                        <img class="img-circle" src="images/test-img2.jpg" alt="" />
                                        <i class="fa fa-quote-left"></i>
                                    </div>

                                    <div class="item_text">
                                        <h5>Sarah Smith</h5>
                                        <h6>envato.com</h6>

                                        <p>Natus voluptatum enim quod necessitatibus quis
                                            expedita harum provident eos obcaecati id culpa
                                            corporis molestias.</p>
                                    </div>
                                </div>
                            </div-->
                        </div>
                    </div>
                </div>
            </section><!-- End off test section -->


            <!--Brand Section-->
            <section id="brand" class="brand fix roomy-80">
                <div class="container">
                    <div class="row">
                        <!--div class="main_brand text-center"-->
                        <div class="col-sm-12" align="center">
                            @foreach($pagina_convenios as $pagina_convenio)    
                                <img src="{{ Storage::url($pagina_convenio -> convenio_imagen) }}" alt="" style="height: 100px !important; margin-right: 30px; margin-left: 30px" />
                            @endforeach
                        </div>
                            <!--div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="images/cbrand-img2.png" alt="" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="images/cbrand-img3.png" alt="" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="images/cbrand-img4.png" alt="" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="images/cbrand-img5.png" alt="" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="images/cbrand-img6.png" alt="" />
                                </div>
                            </div-->
                        <!--/div-->
                    </div>
                </div>
            </section><!-- End off Brand section -->


            <!--Call to  action section-->
            <!--section id="action" class="action bg-primary roomy-40">
                <div class="container">
                    <div class="row">
                        <div class="maine_action">
                            <div class="col-md-8">
                                <div class="action_item text-center">
                                    <h2 class="text-white text-uppercase">Your Promotion Text Will Be Here</h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="action_btn text-left sm-text-center">
                                    <a href="" class="btn btn-default">Purchase Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section-->
        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/animatedModal.min.js"></script>
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
            .buttonHolder{ 
                text-align: center; 
            }
        </style>
        <script>
            $(".demo02").animatedModal();
        </script>
        </body>
        </html>
@stop
