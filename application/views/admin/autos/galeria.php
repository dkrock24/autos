<script src="<?php echo base_url(); ?>../asstes/vendor/jquery/dist/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('change', '.Imagen', function()
        {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                  $('.preview_producto').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


    });
</script>
<!-- Main section-->

<style type="text/css">
    .preview_producto{
        width: 300px;
    }
</style>
<section>
    <!-- Page content-->
    <div class="content-wrapper">  
        <h3 style="height: 50px; font-size: 13px;">  
            <a href="../index" style="top: -12px;position: relative; text-decoration: none">
                <button type="button" class="mb-sm btn btn-pill-left btn-primary btn-outline"> Autos</button> 
            </a> 
            <button type="button" style="top: -12px; position: relative;" class="mb-sm btn btn-info"> Galeria</button>
            
        </h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
            
                    <div class="col-lg-12">

                        <div id="panelDemo10" class="panel panel-info">    
                                                
                            <div class="panel-heading">Galeria Auto : <?php //echo $onMenu[0]->nombre_submenu ?> </div>
                             <div class="panel-body">        
                            <p> 
                            <form class="form-horizontal" enctype="multipart/form-data" name="moneda" action='../fotografia_save' method="post">
                                <input type="hidden" value="<?php echo $car_id; ?>" name="car_id">
                                <div class="row">


                                    <div class="col-lg-6">
                                        <!-- Otro -->
                                        

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Fotografia</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="Imagen" name="foto" class="form-control">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Vista Previa</label>
                                            <div class="col-sm-9">
                                                <img src=""class="preview_producto"/>
                                                                          
                                            </div>
                                        </div>

                                        


                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                
                            
                            </form>
                            </p>                                    
                        </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        Fotografias
                        <br>
                        <?php
                        if (isset($fotos)) {
                            foreach ($fotos as $key => $value) {
                                ?>
                                <div class="col-lg-4" style="padding: 10px;">
                                <a href="../delete_galeria/<?php echo $value->Gallery_id; ?>/<?php echo $value->Car_id; ?>" class="btn btn-danger" style="position: absolute;">Borrar</a>
                                <img src="data: <?php echo $value->Gallery_type ?> ;<?php echo 'base64'; ?>,<?php echo base64_encode( $value->Gallery_image ) ?>" clas="preview_producto" style="width:400px" />
                                </div>

                                <?php
                            }
                        }
                        ?>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
</section>
