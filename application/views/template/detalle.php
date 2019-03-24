<!DOCTYPE html>
<html lang="en">
<head>
<title>Bluesky</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Bluesky template project">
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="<?php echo base_url(); ?>../asstes/styles/bootstrap4/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>../asstes/plugins/font-awesome-4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>../asstes/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>../asstes/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>../asstes/plugins/main_styOwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>../asstes/styles/main_styles.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>../asstes/styles/responsive.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>../asstes/styles/properties.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>../asstes/styles/properties_responsive.css">

<script src="<?php echo base_url(); ?>../asstes/vendor/jquery/dist/jquery.js"></script>


</head>
<body>

<div class="super_container">

  <!-- Header -->

  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="header_content d-flex flex-row align-items-center justify-content-start">
            <div class="logo">
              <a href="#"><img src="<?php echo base_url(); ?>../asstes/images/logo_pagina.png" alt=""></a>
            </div>
            <nav class="main_nav">
              <ul>
                <li class="active"><a href="index.html">Inicio</a></li>
                <li><a href="contact.html">Contacto</a></li>
              </ul>
            </nav>
            <div class="phone_num ml-auto">
              <div class="phone_num_inner">
                <img src="<?php echo base_url(); ?>../asstes/images/phone.png" alt=""><span> <?php echo $persona[0]->phone1; ?></span>
              </div>
            </div>
            <div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Menu -->

  <div class="menu trans_500">
    <div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
      <div class="menu_close_container"><div class="menu_close"></div></div>
      <div class="logo menu_logo">
        <a href="#">
          <div class="logo_container d-flex flex-row align-items-start justify-content-start">
            <div class="logo_image"><div><img src="<?php echo base_url(); ?>../asstes/images/logo_pagina.png" alt=""></div></div>
          </div>
        </a>
      </div>
      <ul>
        <li class="active"><a href="index.html">Inicio</a></li>
                <li><a href="contact.html">Contacto</a></li>
      </ul>
    </div>
    <div class="menu_phone"><span>Llamanos : </span> <?php echo $persona[0]->phone1; ?> </div>
  </div>
  
  <!-- Home -->
<br>
  <div class="recent">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title">
            <a href="../index"><i class="fa fa-arrow-left"></i></a>
            <?php echo $detalle[0]->Brand_name .' '.$detalle[0]->Brand_Line_name ?> / <?php echo $detalle[0]->Car_year.' / '.$detalle[0]->Car_color; ?></div>
          <div class="section_subtitle"></div>
        </div>

       

      </div>


      <div class="row recent_row">

              
              <!-- Slide -->
              <?php
              
              foreach ($galeria as $key => $value) {
                
                  ?>
                  <div class="col-xl-4 col-lg-6 property_col">
                    <div class="property">
                      <div class="property_image">
                        <img src="data: <?php echo $value->Gallery_type ?> ;<?php echo 'base64'; ?>,<?php echo base64_encode( $value->Gallery_image ) ?>" clas="preview_producto" style="width:400px" />
                        
                      </div>
                      <div class="property_body text-center">
                        
                          <div class="recent_item_title"><a href="property.html">$ <?php echo $detalle[0]->Car_price_sale ?></a></div>
                          
                      </div>
                    
                    </div>
                  </div>

                  <?php
              }
              ?>
              


            </div>

            <div class="row">
         <div class="col">
          <h4>Detalles Mecanicos</h4>
          <?php
          if($funciones){
          foreach ($funciones as $key => $value) {
            ?>

            <span style="font-weight: 500;font-size: 18px;"><?php echo $value->Function_name ?></span> |
            <?php
          }
        }
          ?>
        </div>
      </div>
      <hr>
      <div class="row">
         <div class="col">
          <h4>Caracteristicas</h4>
          <?php
          if($accesorios){
          foreach ($accesorios as $key => $value) {
            ?>

            <span style="font-weight: 500;font-size: 18px;"><?php echo $value->Accesorios_name ?></span> |
            <?php
          }
          }
          ?>
        </div>
      </div>

      <hr>
      <div class="row">
         <div class="col">
          
            <span style="font-weight: 500;font-size: 18px;"><?php echo $detalle[0]->Car_description ?></span>
        </div>
      </div>

            <div class="recent_slider_nav_container d-flex flex-row align-items-start justify-content-start">
              <div class="recent_slider_nav recent_slider_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
              <div class="recent_slider_nav recent_slider_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
            </div>
          </div>
       
  </div>






  <!-- Newsletter -->

 

  <!-- Footer -->

  <footer class="footer">
    <div class="footer_main">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="footer_logo"><a href="#"><img width="100px;" src="<?php echo base_url(); ?>../asstes/images/logo_pagina.png" alt=""></a></div>
          </div>
         
        </div>
        <div class="row">
          <div class="col-lg-3 footer_col">
            <div class="footer_about">
              <div class="footer_about_text">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | GeoAutoFacil <i class="fa fa-check" aria-hidden="true"></i> by Rafael Gutierrez</div>
            </div>
          </div>
 <div class="footer_phone ml-auto" style="color: white;"><span>Telefono : </span><?php echo $persona[0]->phone1; ?></div>

        </div>
      </div>
    </div>

  </footer>
</div>

<!-- Modal Large-->
   <div id="detalle" tabindex="-1" role="dialog" aria-labelledby="producto_asociado_modal"  class="modal fade">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header" style="background: #ffc107">
               <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                  <span aria-hidden="true">&times;Cerrar</span>
               </button>
               
            </div>
            <div class="modal-body">
                <p class="auto_detalle"></p>                                 
               
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>               
            </div>
         </div>
      </div>
   </div>
   <!-- Modal Small-->

   <!-- Modal Large-->
   <div id="fotos" tabindex="-1" role="dialog" aria-labelledby="producto_asociado_modal"  class="modal fade">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header" style="background: #ffc107">
               <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                  <span aria-hidden="true">&times;Cerrar</span>
               </button>
               
            </div>
            <div class="modal-body">                                              
               <span class="fotos"></span>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>               
            </div>
         </div>
      </div>
   </div>
   <!-- Modal Small-->


<script src="<?php echo base_url(); ?>../asstes/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>../asstes/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url(); ?>../asstes/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>../asstes/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>../asstes/plugins/easing/easing.js"></script>
<script src="<?php echo base_url(); ?>../asstes/plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?php echo base_url(); ?>../asstes/js/custom.js"></script>
</body>
</html>