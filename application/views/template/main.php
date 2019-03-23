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

<script src="<?php echo base_url(); ?>../asstes/vendor/jquery/dist/jquery.js"></script>

<script type="text/javascript">

    $(document).on('click', '.property_tag', function(){

        var id = $(this).attr('id');
        get_detalle_auto(id);

        $('#detalle').modal('show');

        
    });

    function get_detalle_auto(id){
        var table = "<table class='table table-hover'>";            
            table += "<th>Detalle</th>";
        var table_tr = "<tbody id='list'>";

        $.ajax({
            url: "autos/get_detalle_auto/"+id,  
            datatype: 'json',      
            cache : false,                

                success: function(data){
                    var datos = JSON.parse(data);
                    var productos = datos["detalle"];
                    
                    $.each(productos, function(i, item) {   

                        table_tr += '<tr><td>'+item.Brand_name+" "+item.Brand_Line_name+" / "+item.Car_year+" / "+item.Car_color+'</td><td>';
                        table_tr += '<tr><td>'+item.Car_description+'</td><td>';
                        
                    });

                    funciones = datos["funciones"];
                    table_tr += '<tr><td>';
                    $.each(funciones, function(i, item) {   

                        table_tr += item.Function_name+' / ';
                        
                    });
                    table_tr += '</td><td>';

                    accesorios = datos["accesorios"];
                    table_tr += '<tr><td>';
                    $.each(accesorios, function(i, item) {   

                        table_tr += item.Accesorios_name+' / ';
                        
                    });
                    table_tr += '</td><td>';

                    
                    table += table_tr;
                    table += "</tbody></table>";

                    $(".auto_detalle").html(table);
                
                },
                error:function(){
                }
            });
    }

</script>


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
              <a href="#"><img src="<?php echo base_url(); ?>../asstes/images/logo.png" alt=""></a>
            </div>
            <nav class="main_nav">
              <ul>
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="about.html">About us</a></li>
                <li><a href="properties.html">Properties</a></li>
                <li><a href="news.html">News</a></li>
                <li><a href="contact.html">Contact</a></li>
              </ul>
            </nav>
            <div class="phone_num ml-auto">
              <div class="phone_num_inner">
                <img src="<?php echo base_url(); ?>../asstes/images/phone.png" alt=""><span>652-345 3222 11</span>
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
            <div class="logo_image"><div><img src="<?php echo base_url(); ?>../asstes/images/logo.png" alt=""></div></div>
          </div>
        </a>
      </div>
      <ul>
        <li class="menu_item"><a href="index.html">Home</a></li>
        <li class="menu_item"><a href="about.html">About us</a></li>
        <li class="menu_item"><a href="#">Speakers</a></li>
        <li class="menu_item"><a href="#">Tickets</a></li>
        <li class="menu_item"><a href="news.html">News</a></li>
        <li class="menu_item"><a href="contact.html">Contact</a></li>
      </ul>
    </div>
    <div class="menu_phone"><span>call us: </span>652 345 3222 11</div>
  </div>
  
  <!-- Home -->

  <div class="home">

    <!-- Home Slider -->
    <div class="home_slider_container">
      <div class="owl-carousel owl-theme home_slider">
        
        <!-- Slide -->
        <div class="owl-item">
          <div class="home_slider_background" style="background-image:url(<?php echo base_url(); ?>../asstes/images/home_slider_1x.JPEG)"></div>
          <div class="slide_container">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="slide_content">
                        
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide -->
        <div class="owl-item">
          <div class="home_slider_background" style="background-image:url(<?php echo base_url(); ?>../asstes/images/home_slider_1.jpg)"></div>
          <div class="slide_container">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="slide_content">
                    <div class="home_subtitle">super offer</div>
                    <div class="home_title">Villa with sea view</div>
                    <div class="home_details">
                      <ul class="home_details_list d-flex flex-row align-items-center justify-content-start">
                        <li>
                          <div class="home_details_image"><img src="<?php echo base_url(); ?>../asstes/images/icon_1.png" alt=""></div>
                          <span> 650 Ftsq</span>
                        </li>
                        <li>
                          <div class="home_details_image"><img src="<?php echo base_url(); ?>../asstes/images/icon_2.png" alt=""></div>
                          <span> 3 Bedrooms</span>
                        </li>
                        <li>
                          <div class="home_details_image"><img src="<?php echo base_url(); ?>../asstes/images/icon_3.png" alt=""></div>
                          <span> 2 Bathrooms</span>
                        </li>
                      </ul>
                    </div>
                    <div class="home_price">$ 1. 245 999</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide -->
        <div class="owl-item">
          <div class="home_slider_background" style="background-image:url(<?php echo base_url(); ?>../asstes/images/home_slider_1.jpg)"></div>
          <div class="slide_container">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="slide_content">
                    <div class="home_subtitle">super offer</div>
                    <div class="home_title">Villa with sea view</div>
                    <div class="home_details">
                      <ul class="home_details_list d-flex flex-row align-items-center justify-content-start">
                        <li>
                          <div class="home_details_image"><img src="<?php echo base_url(); ?>../asstes/images/icon_1.png" alt=""></div>
                          <span> 650 Ftsq</span>
                        </li>
                        <li>
                          <div class="home_details_image"><img src="<?php echo base_url(); ?>../asstes/images/icon_2.png" alt=""></div>
                          <span> 3 Bedrooms</span>
                        </li>
                        <li>
                          <div class="home_details_image"><img src="<?php echo base_url(); ?>../asstes/images/icon_3.png" alt=""></div>
                          <span> 2 Bathrooms</span>
                        </li>
                      </ul>
                    </div>
                    <div class="home_price">$ 1. 245 999</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Home Search -->
  <div class="home_search">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="home_search_container" style="width: 70%; left:15%;">
            <div class="home_search_content">
              <form action="#" class="search_form d-flex flex-row align-items-start justfy-content-start">
                <div class="search_form_content d-flex flex-row align-items-start justfy-content-start flex-wrap">
                  <div style="width: 50%">
                    <select class="search_form_select">                      
                      <option value="c">Comprar</option>
                      <option value="r">Rentar</option>
                    </select>
                  </div>
                  <div style="width: 50%;">
                    <select class="search_form_select form-control">
                      <?php
                      foreach ($brands as $key => $value) {
                        ?>
                        <option value="<?php echo $value->Brand_id ?>"><?php echo $value->Brand_name ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
             
                </div>
                <button class="search_form_button ml-auto">search</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent -->

  <div class="recent">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title">Venta y Alquiler</div>
          <div class="section_subtitle">Los Mejores Precios</div>
        </div>
      </div>
      <div class="row recent_row">
        <div class="col">
          <div class="recent_slider_container">
            <div class="owl-carousel owl-theme recent_slider">
              
              <!-- Slide -->
              <?php
              $auto = 0;
              foreach ($autos as $key => $value) {
                if($auto != $value->Car_id ){
                  ?>
                  <div class="owl-item">
                    <div class="recent_item">
                      <div class="recent_item_inner">
                        <div class="recent_item_image">
                            <img src="data: <?php echo $value->Gallery_type ?> ;<?php echo 'base64'; ?>,<?php echo base64_encode( $value->Gallery_image ) ?>" clas="preview_producto" style="width:400px" />
                          
                          <div class="tag_featured property_tag"><a href="#">Detalle</a></div>
                        </div>
                        <div class="recent_item_body text-center">
                          <div class="recent_item_location"><?php echo $value->Car_year.' / '.$value->Car_color; ?></div>
                          <div class="recent_item_title"><a href="property.html"><?php echo $value->Brand_name .' '.$value->Brand_Line_name ?></a></div>
                          <div class="recent_item_price">$ <?php echo $value->Car_price_sale; ?></div>
                        </div>
                        <div class="recent_item_footer d-flex flex-row align-items-center justify-content-start">
                          <div><div class="recent_icon"><i class="fa fa-check"></i></div><span>Negociable </span> | </div>
                          <div><div class="recent_icon"><i class="fa fa-check"></i></div><span>Venta | </span></div>
                          <div><div class="recent_icon"><i class="fa fa-check"></i></div><span>Alquiler |</span></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php
                  $auto = $value->Car_id;
                }
              }
              ?>
              


            </div>

            <div class="recent_slider_nav_container d-flex flex-row align-items-start justify-content-start">
              <div class="recent_slider_nav recent_slider_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
              <div class="recent_slider_nav recent_slider_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>

  <!-- Cities -->

  <div class="cities">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title">Autos En Alquiler</div>
          <div class="section_subtitle"> </div>
        </div>
      </div>
    </div>
    
    <div class="cities_container d-flex flex-row flex-wrap align-items-start justify-content-between">

      <!-- City -->

      <?php
      foreach ($alquiler as $key => $value) {
          ?>

          <div class="city">
            <img src="data: <?php echo $value->Gallery_type ?> ;<?php echo 'base64'; ?>,<?php echo base64_encode( $value->Gallery_image ) ?>" clas="preview_producto" style="width:400px" />
            
            <div class="city_overlay">
              <a href="#" class="d-flex flex-column align-items-center justify-content-center">
                <div class="city_title"><?php echo $value->Brand_name .' '.$value->Brand_Line_name ?></div>
                <div class="city_subtitle"><?php echo $value->Car_year.' / '.$value->Car_color; ?></div>
              </a>  
            </div>
            <div class="recent_item_footer d-flex flex-row align-items-center justify-content-start">
                <div>
                    <div class="recent_icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <span>$  <?php echo $value->Car_price_rental ?> Por Dia</span> 
                </div>  
                <div><div class="recent_icon"></div><span>
                    <div class="tag_featured property_tag" id="<?php echo $value->Car_id; ?>" style="top: -5px;"><span class="btn btn-default">Detalle</span></div>  
                </span></div>
                         
            </div>

          </div>

          <?php
      }
      ?>
      



    </div>
  </div>

  <!-- Testimonials -->


  <!-- Newsletter -->

 

  <!-- Footer -->

  <footer class="footer">
    <div class="footer_main">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="footer_logo"><a href="#"><img src="<?php echo base_url(); ?>../asstes/images/logo_large.png" alt=""></a></div>
          </div>
          <div class="col-lg-9 d-flex flex-column align-items-start justify-content-end">
            <div class="footer_title">Latest Properties</div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 footer_col">
            <div class="footer_about">
              <div class="footer_about_text">Donec in tempus leo. Aenean ultricies mauris sed quam lacinia lobortis. Cras ut vestibulum enim, in gravida nulla. Curab itur ornare nisl at sagittis cursus.</div>
            </div>
          </div>
          <div class="col-lg-3 footer_col">
            <div class="footer_latest d-flex flex-row align-items-start justify-content-start">
              <div><div class="footer_latest_image"><img src="<?php echo base_url(); ?>../asstes/images/footer_latest_1.jpg" alt=""></div></div>
              <div class="footer_latest_content">
                <div class="footer_latest_location">Miami</div>
                <div class="footer_latest_name"><a href="#">Sea view property</a></div>
                <div class="footer_latest_price">$ 1. 234 981</div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 footer_col">
            <div class="footer_latest d-flex flex-row align-items-start justify-content-start">
              <div><div class="footer_latest_image"><img src="<?php echo base_url(); ?>../asstes/images/footer_latest_2.jpg" alt=""></div></div>
              <div class="footer_latest_content">
                <div class="footer_latest_location">Miami</div>
                <div class="footer_latest_name"><a href="#">Town House</a></div>
                <div class="footer_latest_price">$ 1. 234 981</div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 footer_col">
            <div class="footer_latest d-flex flex-row align-items-start justify-content-start">
              <div><div class="footer_latest_image"><img src="<?php echo base_url(); ?>../asstes/images/footer_latest_3.jpg" alt=""></div></div>
              <div class="footer_latest_content">
                <div class="footer_latest_location">Miami</div>
                <div class="footer_latest_name"><a href="#">Modern House</a></div>
                <div class="footer_latest_price">$ 1. 234 981</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer_bar">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="footer_bar_content d-flex flex-row align-items-center justify-content-start">
              <div class="cr"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
              <div class="footer_nav">
                <ul>
                  <li><a href="index.html">Home</a></li>
                  <li><a href="#">About us</a></li>
                  <li><a href="properties.html">Properties</a></li>
                  <li><a href="news.html">News</a></li>
                  <li><a href="contact.html">Contact</a></li>
                </ul>
              </div>
              <div class="footer_phone ml-auto"><span>call us: </span>652 345 3222 11</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>

<!-- Modal Large-->
   <div id="detalle" tabindex="-1" role="dialog" aria-labelledby="producto_asociado_modal"  class="modal fade">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 id="myModalLabelLarge" class="modal-title">Auto Detalle</h4>
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


<script src="<?php echo base_url(); ?>../asstes/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>../asstes/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url(); ?>../asstes/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>../asstes/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>../asstes/plugins/easing/easing.js"></script>
<script src="<?php echo base_url(); ?>../asstes/plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?php echo base_url(); ?>../asstes/js/custom.js"></script>
</body>
</html>