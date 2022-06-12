<?php 
require './conexion.php';

if($_SERVER["REQUEST_METHOD"]=="GET")
                    {
                        // $sqlAll="SELECT Usu.id, Usu.nombre, Usu.email, Usu.rol, UsuP.parcela, UsuP.usuario  FROM usuarios Usu INNER JOIN usuarios_parcelas UsuP ON Usu.id = UsuP.usuario";
                        $sql = "SELECT * FROM usuarios WHERE id = '".$_GET["id"]."'";
                        // $sqlParcelas = "SELECT * FROM usuarios_parcelas";
                        // $resultParcelas = mysqli_query($data, $sqlParcelas);
                        $result=mysqli_query($data,$sql);
                        $aux=0;                        

                        while($row=mysqli_fetch_array($result)){


                            if($row["rol"] == "user"){

                                // --------------------------------------------
                                // SCRIPT PARA CALCULAR PARCELAS
                                // --------------------------------------------
                                ?>
                                <form action="procesar_actualizacion.php?id=<?php echo $row["id"]?>" method="post" accept-charset='UTF-8'>
                                        <tr id="fila_tabla">
                                        <th scope="row" ><?php echo $row["id"] ?></th>
                                        <td> <input type="text" name="new_usuario" value="<?php echo $row["nombre"]; ?>"> </td>
                                        <td> <input type="text" name="new_email" value="<?php echo $row["email"]; ?>"> </td>
                                        <td>
                                            <button type="submit" class="actualizar">Guardar</button> 
                                        </td>
                                    </tr>

                                </form>
                                    
                                <?php
                            }
                        }
                    }

?>