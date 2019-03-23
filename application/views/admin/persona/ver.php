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
            <a href="../index" style="top: -12px;position: relative; text-decoration: none">
                <button type="button" class="mb-sm btn btn-pill-left btn-primary btn-outline"> Autos</button> 
            </a> 
            <button type="button" style="top: -12px; position: relative;" class="mb-sm btn btn-info"> Nuevo</button>
            
        </h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
            
                    <div class="col-lg-12">

                        <div id="panelDemo10" class="panel panel-info">    
                                                
                            <div class="panel-heading">Auto Rentado : <?php //echo $onMenu[0]->nombre_submenu ?> </div>
                             <div class="panel-body">        
                            <p> 
                            <form class="form-horizontal" name="moneda" action='save' method="post">
                                <input type="hidden" value="<?php //echo $onMenu[0]->id_submenu; ?>" name="id_submenu">
                                <div class="row">


                                    <div class="col-lg-6">
                                        <table class="table">
                                        	<tr>
                                            	<td colspan="2">
                                            		
                                            		<h3>Datos Cliente</h3>
                                            	</td>
                                            </tr>

                                        	<tr>
                                                <td>Marca</td>
                                                <td><?php echo $rentado[0]->full_name ?></td>
                                            </tr>
                                            <tr>
                                                <td>Edad</td>
                                                <td><?php echo $rentado[0]->age ?></td>
                                            </tr>
                                            <tr>
                                                <td>DUI</td>
                                                <td><?php echo $rentado[0]->dui ?></td>
                                            </tr>

                                            <tr>
                                                <td>NIT</td>
                                                <td><?php echo $rentado[0]->nit ?></td>
                                            </tr>
                                            <tr>
                                                <td>Licencia</td>
                                                <td><?php echo $rentado[0]->licence ?></td>
                                            </tr>
                                            <tr>
                                                <td>Direccion</td>
                                                <td><?php echo $rentado[0]->address ?></td>
                                            </tr>
                                            <tr>
                                                <td>Telefono 1</td>
                                                <td><?php echo $rentado[0]->phone1 ?></td>
                                            </tr>
                                            <tr>
                                                <td>Telefono 2</td>
                                                <td><?php echo $rentado[0]->phone2 ?></td>
                                            </tr>
                                            <tr>
                                                <td>Fecha Inicio</td>
                                                <td><?php $date = new DateTime($rentado[0]->date_start); echo $date->format('M-d-Y / H:i'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Fecha Fin</td>
                                                <td><?php $date = new DateTime($rentado[0]->date_end); echo $date->format('M-d-Y / H:i'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Monto</td>
                                                <td><?php echo $rentado[0]->amount ?></td>
                                            </tr>
                                            <tr>
                                                <td>Deposito</td>
                                                <td><?php echo $rentado[0]->deposito ?></td>
                                            </tr>

                                            <tr>
                                            	<td colspan="2">
                                            		
                                            		<h3>Datos Auto</h3>
                                            	</td>
                                            </tr>

                                            <tr>
                                                <td>Marca</td>
                                                <td><?php echo $rentado[0]->Brand_name ?></td>
                                            </tr>
                                            <tr>
                                                <td>Modelo</td>
                                                <td><?php echo $rentado[0]->Brand_Line_name ?></td>
                                            </tr>
                                            <tr>
                                                <td>Descripcion</td>
                                                <td><?php echo $rentado[0]->Car_description ?></td>
                                            </tr>
                                            <tr>
                                                <td>Precio Venta</td>
                                                <td><?php echo $rentado[0]->Car_price_sale ?></td>
                                            </tr>

                                            <tr>
                                                <td>Precio Renta</td>
                                                <td><?php echo $rentado[0]->Car_price_rental ?></td>
                                            </tr>
                                            <tr>
                                                <td>Negociable</td>
                                                <td><?php if($rentado[0]->Car_negociable==1){ 
                                                    ?>
                                                    <span class="label label-success">Si</span>
                                                    <?php }else{
                                                        ?><span class="label label-danger">No</span><?php
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Vendido</td>
                                                <td><?php if($rentado[0]->Car_sale==1){ 
                                                    ?>
                                                    <span class="label label-success">Si</span>
                                                    <?php }else{
                                                        ?><span class="label label-danger">No</span><?php
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rentado</td>
                                                <td><?php if($rentado[0]->Car_rental==1){ 
                                                    ?>
                                                    <span class="label label-success">Si</span>
                                                    <?php }else{
                                                        ?><span class="label label-danger">No</span><?php
                                                    } ?>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Año</td>
                                                <td><?php echo $rentado[0]->Car_year ?></td>
                                            </tr>

                                            <tr>
                                                <td>Color</td>
                                                <td><?php echo $rentado[0]->Car_color ?></td>
                                            </tr>
                                            <tr>
                                                <td>Creado</td>
                                                <td><?php $date = new DateTime($rentado[0]->created); echo $date->format('M-d-Y / H:i');  ?></td>
                                            </tr>
                                            

                                            <tr>
                                                <td>Estado</td>
                                                
                                                <td><?php if($rentado[0]->rentado_estado==1){ 
                                                    ?>
                                                    <span class="label label-success">Activo</span>
                                                    <?php }else{
                                                        ?><span class="label label-danger">Inactivo</span><?php
                                                    } ?>
                                                </td>
                                            </tr>

                                            <tr>
                                            	<td colspan="2">
                                            		
                                            		<h3>Caracterisiticas</h3>
                                            	</td>
                                            </tr>

                                            <?php
                                            foreach ($funciones as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td> Caracteristica </td>
                                                    <td><?php echo $value->Function_name; ?></td>
                                                    
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                            	<td colspan="2">
                                            		
                                            		<h3>Accesorios</h3>
                                            	</td>
                                            </tr>
                                            <?php
                                            foreach ($accesorios as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td> Accesorio </td>
                                                    <td><?php echo $value->Accesorios_name; ?></td>
                                                    
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                        </table>                                       


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
