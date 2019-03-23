<script src="<?php echo base_url(); ?>../asstes/vendor/jquery/dist/jquery.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        $("#departamento").change(function(){
            $("#ciudad").empty();
            var html_option;
            var departamento = $(this).val();

            $.ajax({
                url: "getCiudadId/"+departamento,
                datatype: 'json',      
                cache : false,                

                success: function(data){
                    var datos = JSON.parse(data);
                    var ciudad = datos["ciudad"];

                   $.each(ciudad, function(i, item) { 
                    html_option += "<option>"+item.nombre_ciudad+"</option>";
                   });
                    $("#ciudad").html(html_option);           
                },
                error:function(){
                }
            });           
        });
    });
</script>
<!-- Main section-->
<section>
    <!-- Page content-->
    <div class="content-wrapper">  
        <h3 style="height: 50px; font-size: 13px;">  
            <a href="../index" style="top: -12px;position: relative; text-decoration: none">
                <button type="button" class="mb-sm btn btn-pill-left btn-primary btn-outline"> Alquiler</button> 
            </a> 
            <button type="button" style="top: -12px; position: relative;" class="mb-sm btn btn-info"> Editar</button>
            
        </h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
            
                    <div class="col-lg-12">

                        <div id="panelDemo10" class="panel panel-info">    
                                                
                            <div class="panel-heading">Editar Alquiler : <?php //echo $onMenu[0]->nombre_submenu ?> </div>
                             <div class="panel-body">        
                            <p> 
                            <form class="form-horizontal" name="persona" action='../update' method="post">
                                <input type="hidden" value="<?php echo $rentado[0]->Car_rental_id; ?>" name="Car_rental_id">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label no-padding-right">Auto</label>
                                            <div class="col-sm-9">
                                               <select name="Car_id" class="form-control">
                                                   <?php
                                                   foreach ($autos as $key => $value) {
                                                        if($value->Car_id == $rentado[0]->Car_id){
                                                           ?>
                                                           <option value="<?php echo $value->Car_id ?>"><?php echo $value->Brand_name .' '. $value->Brand_Line_name .' '. $value->Car_year .' '. $value->Car_color; ?></option>
                                                           <?php
                                                       }
                                                   }
                                                   foreach ($autos as $key => $value) {
                                                        if($value->Car_id != $rentado[0]->Car_id){
                                                           ?>
                                                           <option value="<?php echo $value->Car_id ?>"><?php echo $value->Brand_name .' '. $value->Brand_Line_name .' '. $value->Car_year .' '. $value->Car_color; ?></option>
                                                           <?php
                                                       }
                                                   }
                                                   ?>
                                               </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Nombre Completo</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="" value="<?php echo $rentado[0]->full_name ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Edad</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="age" name="age" placeholder="" value="<?php echo $rentado[0]->age ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">DUI</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="dui" name="dui" placeholder="" value="<?php echo $rentado[0]->dui ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">NIT</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nit" name="nit" placeholder="" value="<?php echo $rentado[0]->nit ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Licencia</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="licence" name="licence" placeholder="" value="<?php echo $rentado[0]->licence ?>">
                                                
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Direccion</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="address" name="address" placeholder="" value="<?php echo $rentado[0]->address ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Telefono 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="phone1" name="phone1" placeholder="" value="<?php echo $rentado[0]->phone1 ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Telefono 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="phone2" name="phone2" placeholder="" value="<?php echo $rentado[0]->phone2 ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Alquiler Inicio</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="date_start" name="date_start" placeholder="" value="<?php $date = new DateTime($rentado[0]->date_start); echo $date->format('Y-m-d'); ?>">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Alquiler Fin</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="date_end" name="date_end" placeholder="" value="<?php $date = new DateTime($rentado[0]->date_end); echo $date->format('Y-m-d'); ?>">
                                                
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Precio dia $</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="amount" name="amount" placeholder="" value="<?php echo $rentado[0]->amount ?>">
                                                
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label no-padding-right">Deposito $</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="deposito" name="deposito" placeholder="" value="<?php echo $rentado[0]->deposito ?>">
                                                
                                            </div>
                                        </div>    

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                
                                                <label>
                                                    <select name="rentado_estado" class="form-control">
                                                        <?php
                                                        if( $rentado[0]->rentado_estado ==1 ){ 
                                                            ?>
                                                                <option value="1">Activo</option>
                                                                <option value="0">Inactivo</option>
                                                                <?php
                                                            } else{
                                                                 ?>
                                                                <option value="0">Inactivo</option>
                                                                <option value="1">Activo</option>
                                                                <?php
                                                            }
                                                        ?>
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
