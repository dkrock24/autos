<!-- Main section-->
    <section>
        <!-- Page content-->
        <div class="content-wrapper">
            <h3 style="height: 50px; font-size: 13px;">                
                <a href="index" style="top: -12px;position: relative; text-decoration: none">
                    <button type="button" class="mb-sm btn btn-pill-left btn-primary btn-outline"> Editar Modelos</button> 
            </a> 
            <button type="button" style="top: -12px; position: relative;" class="mb-sm btn btn-info">Editar</button>
            </h3>
            <div class="panel panel-default">
                <div class="panel-heading">Editar Modelo</div>
                <!-- START table-responsive-->
                <div class="">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-white">

                                <div class="panel-body">
                                    <div class="col-lg-6">
                                        <div id="" class="panel panel-info">
                                            <div class="panel-heading">Modelo Formulario : <?php //echo $roles[0]->role ?> </div>
                                            <p>
      
                                            <div class="panel-body">
                                                <form class="form-horizontal" action='../update' method="post">
                                                    <input type="hidden" name="Brand_Line_id" value="<?php echo $modelo[0]->Brand_Line_id ?>">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-2 control-label no-padding-right">Marca</label>
                                                        <div class="col-sm-10">
                                                            <select name="Brand_id" class="form-control">
                                                                <?php
                                                                foreach ($brand as $key => $value) {
                                                                    if($value->Brand_id == $modelo[0]->Brand_id){
                                                                    ?>
                                                                    <option value="<?php echo $value->Brand_id; ?>"><?php echo $value->Brand_name; ?></option>
                                                                    <?php
                                                                    }
                                                                }
                                                                foreach ($brand as $key => $value) {
                                                                    if($value->Brand_id != $modelo[0]->Brand_id){
                                                                    ?>
                                                                    <option value="<?php echo $value->Brand_id; ?>"><?php echo $value->Brand_name; ?></option>
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword3" class="col-sm-2 control-label no-padding-right">Modelo</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="Brand_Line_name" name="Brand_Line_name" value="<?php echo $modelo[0]->Brand_Line_name ?>">
                                                            
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group">
                                                        <label for="inputPassword3" class="col-sm-2 control-label no-padding-right">Descripcion</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="Brand_Line_description" name="Brand_Line_description" value="<?php echo $modelo[0]->Brand_Line_description ?>">
                                                            
                                                        </div>
                                                    </div>    

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                                <label>
                                                                    <select name="Brand_Line_status" class="form-control">
                                                                        
                                                                          <?php
                                                                            if( $modelo[0]->Brand_Line_status ==1 ){ 
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
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
