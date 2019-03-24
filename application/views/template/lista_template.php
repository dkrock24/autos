<script src="<?php echo base_url(); ?>/asstes/vendor/jquery/dist/jquery.js"></script>

<script type="text/javascript">
    
    $(document).on("change","#total_pagina",function(){
        $.ajax({
            type: "post",
            url: "",
            success: function() {
                //location.reload();
                $('#pagina_x').submit();
            }
        });
    });

</script>

<!-- Main section-->
    <section>
        <!-- Page content-->
        <div class="content-wrapper">
            <h3 style="height: 50px; "><?php echo $fields['titulo']; ?> </h3>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-lg-1 text-left">
                        <form method="post" id="pagina_x" name="data">
                        <select class="form-control" id="total_pagina" name="total_pagina">
                            <option class="0">-</option>
                            <option class="10">10</option>
                            <option class="15">15</option>
                            <option class="20">20</option>
                            <option class="50">50</option>
                            <option class="100">100</option>
                        </select>
                        </form>
                    </div>
                </div>
                <!-- START table-responsive-->
                <div class="">
                    <table id="datatable1" class="table table-striped table-hover">
                        <thead>
                            <tr>
                              <?php
                              foreach ($column as $key => $combo) {
                                ?>
                                <th><?php echo $combo; ?></th>
                                <?php
                              }
                              ?>
                                
                                <th>
                                    <a href="nuevo" class="btn btn-default">Nuevo</a>
                                    
                                </th>                            
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $contador = $contador_tabla;
                            if($registros){
                                foreach ($registros as $table) {
                                    $id =  $fields['id'][0];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $contador; ?></th>
                                    <?php
                                    foreach ($fields['field'] as $key => $field) {

                                    if($field != 'estado'){
                                    ?>
                                      <td><?php echo $table->$field; ?></td>
                                    <?php
                                    }
                                        if($field == 'estado'){
                                            $estado = $fields['estado'][0];
                                            ?>
                                            <td>
                                                <?php 
                                                    if($table->$estado == 1){
                                                        ?>
                                                        <span class="label label-success">Activo</span>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <span class="label label-warning">Inactivo</span>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                            
                                            <?php
                                        }
                                    }
                                    ?>
                                    
                                
                                <td>
                                                                  
                                    <div class="btn-group mb-sm">
                                        <button type="button" data-toggle="dropdown" class="btn dropdown-toggle btn-primary btn-xs">Opcion
                                                <span class="caret"></span>
                                            </button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="ver/<?php echo $table->$id; ?>">Ver</a></li>
                                            <li><a href="editar/<?php echo $table->$id; ?>">Modificar</a></li>
                                                                                                                                                         
                                            <li class="divider"></li>  
                                            
                                        </ul>
                                    </div>
                                
                                </td>
                            </tr>
                                <?php
                            $contador+=1;
                        }
                        }
                      ?>                       
                                   
                        </tbody>
                    </table>

                </div>
                <div class="row">
                    
                    <div class="col-lg-12 text-right">
                        <ul class="pagination pagination-md">
                           <?php foreach ($links as $link) {
                            echo "<li class='page-item '>". $link ."</li>";
                        } ?>
                        </ul>
                    </div>

                </div>
                
            </div>
        </div>


    </div>
</section>
