<script src="<?php echo base_url(); ?>../asstes/vendor/jquery/dist/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $("#marca").change(function(){
            $("#modelo").empty();
            var html_option;
            var marca = $(this).val();

            $.ajax({
                url: "getModelo/"+marca,
                datatype: 'json',      
                cache : false,                

                success: function(data){
                    var datos = JSON.parse(data);
                    var modelos = datos;

                   $.each(modelos, function(i, item) { 
                    html_option += "<option value='"+item.Brand_Line_id+"'>"+item.Brand_Line_name+"</option>";
                   });
                    $("#modelo").html(html_option);           
                },
                error:function(){
                }
            });           
        });

        function typeInput(valueInput){
            switch(valueInput){
                case 'select' : drawSelect( valueInput );
                break;
                case 'check' : drawSelect( valueInput );
                break;
                case 'radio' : drawSelect( valueInput );
                break;
            }
        }

        $(".agregar").click(function(){
            var tipo = $(".agregar").attr('name');
            typeInput(tipo);
        });
        
        cont = 1;
        function drawSelect( valueInput ){
            $(".agregar").attr('name', valueInput);
            var inputValue = "<div class='form-group'><div class='col-sm-2'>Opcion "+cont+"</div><div class='col-sm-9'><input type='text' name='option"+cont+"' value='' class='form-control'/></div><div class='col-sm-1'><a href='#' class='removeInput'><i class='fa fa-remove'></i></a></div>";
            var inputValue2 = "</div>";
            $("#atributosOptios").append( inputValue + inputValue2 );
            cont++;
        }

        function clearOption(){
            $("#atributosOptios").empty();
            cont=1;
        }


    });
</script>
<!-- Main section-->
<section>
    <!-- Page content-->
    <div class="content-wrapper">  
        <h3 style="height: 50px; font-size: 13px;">  
            <a href="index" style="top: -12px;position: relative; text-decoration: none">
                <button type="button" class="mb-sm btn btn-pill-left btn-primary btn-outline"> Autos</button> 
            </a> 
            <button type="button" style="top: -12px; position: relative;" class="mb-sm btn btn-info"> Nuevo</button>
            
        </h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
            
                    <div class="col-lg-12">

                        <div id="panelDemo10" class="panel panel-info">    
                                                
                            <div class="panel-heading">Nuevo Auto : <?php //echo $onMenu[0]->nombre_submenu ?> </div>
                             <div class="panel-body">        
                            <p> 
                            <form class="form-horizontal" name="moneda" action='save' method="post">
                                <input type="hidden" value="<?php //echo $onMenu[0]->id_submenu; ?>" name="id_submenu">
                                <div class="row">


                                    <div class="col-lg-6">
                                        <!-- Otro -->
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label no-padding-right">Marca</label>
                                            <div class="col-sm-9">
                                               <select id="marca" name="marca" class="form-control">
                                                    <?php
                                                    foreach ($brand as $key => $value) {
                                                        ?>
                                                        <option value="<?php echo $value->Brand_id; ?>"><?php echo $value->Brand_name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Modelo</label>
                                            <div class="col-sm-9">
                                                <select id="modelo" name="Brand_Line_id" class="form-control">
                                                    
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Precio Venta</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="Car_price_sale" name="Car_price_sale" placeholder="" value="<?php //echo $onMenu[0]->url_submenu ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Precio Renta</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="Car_price_rental" name="Car_price_rental" placeholder="" value="<?php //echo $onMenu[0]->url_submenu ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Negociable</label>
                                            <div class="col-sm-9">
                                                <select name="Car_negociable" class="form-control">
                                                    <option value="1">Si</option>
                                                    <option value="0">No</option>
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Para Venta</label>
                                            <div class="col-sm-9">
                                                <select name="Car_sale" class="form-control">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Para Renta</label>
                                            <div class="col-sm-9">
                                                <select name="Car_rental" class="form-control">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>   
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Año</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="Car_year" name="Car_year" placeholder="" value="<?php //echo $onMenu[0]->url_submenu ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Color</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="Car_color" name="Car_color" placeholder="" value="<?php //echo $onMenu[0]->url_submenu ?>">
                                                
                                            </div>
                                        </div>

                                       <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Descripcion</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="Car_description" name="Car_description" placeholder="" value="<?php //echo $onMenu[0]->url_submenu ?>">
                                                
                                            </div>
                                        </div>

                                        

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                
                                                <label>
                                                    <select name="Car_status" class="form-control">
                                                        <option value="1">Activo</option>
                                                        <option value="0">Inactivo</option>
                                                    </select>
                                                </label>
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
            
                </div>
            </div>
        </div>
    </div>
</section>
