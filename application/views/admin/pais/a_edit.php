<!-- Main section-->
    <section>
        <!-- Page content-->
        <div class="content-wrapper">            
            
            <h3 style="height: 50px; font-size: 13px;">                
                <a href="../index" style="top: -12px;position: relative; text-decoration: none">
                    <button type="button" class="mb-sm btn btn-pill-left btn-primary btn-outline"> Accesorios</button> </a> 
                    <button type="button" style="top: -12px; position: relative;" class="mb-sm btn btn-info">/ Editar</button>
                </h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-white">

                        <div class="panel-body">
                            <div class="col-lg-6">
                               
                                <div id="" class="panel panel-info">
                                    <div class="panel-heading">Editar Accesorio :  </div>
                                        <p>
                                        <form class="form-horizontal" action='../update' method="post">
                                        <input type="hidden" name="Accesorio_id" value="<?php echo $accesorio[0]->Accesorio_id ?>" >        
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label no-padding-right">Nombre</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="Accesorios_name" name="Accesorios_name" placeholder="" value="<?php echo $accesorio[0]->Accesorios_name ?>">
                                                    
                                                </div>
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-2 control-label no-padding-right">Descripcion</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="Accesorios_descripcion" name="Accesorios_descripcion" placeholder="" value="<?php echo $accesorio[0]->Accesorios_descripcion ?>">
                                                    
                                                </div>
                                            </div>
      

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    
                                                    <label>
                                                        <select name="Accesorios_status" class="form-control">
                                                            <?php 
                                                                    if( $accesorio[0]->Accesorios_status ==1 ){ 
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
                                        </p>
                                </div>
                              
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
