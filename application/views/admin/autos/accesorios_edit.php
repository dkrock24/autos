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
            <button type="button" style="top: -12px; position: relative;" class="mb-sm btn btn-info"> Editar Accesorios</button>
            
        </h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
            
                    <div class="col-lg-12">

                        <div id="panelDemo10" class="panel panel-info">    
                                                
                            <div class="panel-heading">Editar Accesorios Auto : <?php //echo $onMenu[0]->nombre_submenu ?> </div>
                             <div class="panel-body">        
                            <p> 
                            <form class="form-horizontal" name="moneda" action='../save_accesorios1' method="post">
                                
                                <div class="row">

                                    <input type="hidden" name="car_id" value="<?php echo $car; ?>">

                                    <?php
                                    foreach ($allAccesorios as $key => $value) {
                                        ?>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label no-padding-right"><?php echo $value->Accesorios_name ?></label>
                                            <div class="col-sm-10">

                                                <div class="checkbox c-checkbox">
                                                    <label>
                                                        <?php
                                                        $check='';
                                                        if($accesorios){
                                                        foreach ($accesorios as $key => $a) {
                                                            if($a->Accesorio_id == $value->Accesorio_id ){
                                                                $check = "checked";    
                                                            }
                                                        }
                                                        }
                                                                                                                
                                                        ?>
                                                       <input type="checkbox" <?php echo $check; ?> name="<?php echo $value->Accesorio_id; ?>">
                                                       <span class="fa fa-check"></span></label>
                                                 </div>                                                                                         
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
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
