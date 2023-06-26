<?php

include("assets/config/bd.php");
error_reporting (E_ALL);
set_error_handler(function () 
  {
    throw new Exception("Error");
  });
?>

<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtCategoria=(isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";
$txtProveedor=(isset($_POST['txtProveedor']))?$_POST['txtProveedor']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

// print_r($txtImagen);
// $divi=8/0;

include("assets/config/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL= $conexion->prepare("INSERT INTO `pethouse`.`producto` (`idProducto`,`nombreProducto`, `marcaProducto` , `categoriaProducto`,`imagenProducto` ,`descripcion` ) VALUES (:id, :nombre, :proveedor, :categoria, :imagen, :descripcion );");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':categoria',$txtCategoria);
       // $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);   
        $sentenciaSQL->bindParam(':proveedor',$txtProveedor);        

        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!=="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"assets/img/productos/".$nombreArchivo);

        }

        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->execute();

        header("Location:productos.php");
        break;

    case "Modificar":

        $sentenciaSQL=$conexion->prepare("UPDATE producto SET nombreProducto=:nombre, precioProducto=:precio, descripcion=:descripcion, marcaProducto=:proveedor, categoriaProducto=:categoria WHERE idProducto=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':proveedor',$txtProveedor);
        $sentenciaSQL->bindParam(':categoria',$txtCategoria);

        $sentenciaSQL->execute();
        
        if($txtImagen != ""){

            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!=="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen,"assets/img/productos/".$nombreArchivo);

            $sentenciaSQL=$conexion->prepare("SELECT imagenProducto FROM producto WHERE idProducto=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if(isset($producto["imagenProducto"]) && ($producto["imagenProducto"]!="imagen.jpg" )) {
                    if(file_exists("assets/img/productos/".$producto["imagenProducto"])){
                        unlink("assets/img/productos/".$producto["imagenProducto"]);

                    }
                }

            $sentenciaSQL=$conexion->prepare("UPDATE producto SET imagenProducto=:imagen WHERE idProducto=:id");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }

        //echo "presionado boton modificar";
        header("Location:productos.php");
        break;

    case "Cancelar":
        header("Location:productos.php");
       // echo "presionado bonton cancelar";
        break;

    case "Seleccionar":

        $sentenciaSQL=$conexion->prepare("SELECT * FROM producto WHERE idProducto=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
        $txtNombre=$producto['nombreProducto'];
        $txtImagen=$producto['imagenProducto'];
        $txtPrecio=$producto['precioProducto'];
        $txtDescripcion=$producto['descripcion'];
        $txtCategoria=$producto['categoriaProducto'];
        $txtProveedor=$producto['marcaProducto'];
        
        //echo "presionado bonton Seleccionar";
    
        break;
        
    case "Borrar":
             
        $sentenciaSQLImg=$conexion->prepare("SELECT imagenProducto FROM producto WHERE idProducto=:id");
        $sentenciaSQLImg->bindParam(':id',$txtID);
        $sentenciaSQLImg->execute(); 
        
        $producto=$sentenciaSQLImg->fetch(PDO::FETCH_LAZY);

        if(isset($producto["imagenProducto"]) && ($producto["imagenProducto"]!="imagen.jpg" )) {
            if(file_exists("assets/img/productos/".$producto["imagenProducto"])){
                unlink("assets/img/productos/".$producto["imagenProducto"]);
            }
        }
        
        $sentenciaSQL=$conexion->prepare("DELETE FROM producto WHERE idProducto=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        //$sentenciaSQL->execute();
      
        try{
            $sentenciaSQL->execute();
             
        }
        catch(Exception $e){
              //mostramos el texto del error al usuario	  
            $x = substr($e, 23, 5);  
            //echo $x; echo $dic=8/0;
                if ($x == "23000" ){                    
                    echo '<script> alert("Debe borrar el Item en compra de producto para poder eliminarlo por completo");window.location.href="productos.php"</script>';                  
                }
        break;
        }

        //echo "presionado bonton Borrar";
        header("Location:productos.php");

        break;

    }

$sentenciaSQL=$conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

// $sentenciaSQL=$conexion->prepare("SELECT * FROM proveedor");
// $sentenciaSQL->execute();
// $listaProveedor=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


$sentenciaSQL=$conexion->prepare("SELECT * FROM distribuidor");
$sentenciaSQL->execute();
$listaProveedor=$sentenciaSQL->fetch();

//print_r($_POST);
//print_r($_FILES);
//print_r($listaLibros);
    ?>
    <?php
    include("headerAdmin.php");
    ?>

<script type="text/javascript">
    function confirmacion(){
        var respuesta = confirm("Seguro que desea eliminar el producto?");
        if (respuesta == true){
            return true;
        }else{
            return false;
        }
    }
</script>

    <div class="container">
    <br/>
        <div class="row">
            <div class="col-md-4">
            </br></br></br></br>
                <div class="card">
                    <div class="card-header">
                        Ingresar Producto Nuevo
                    </div>

                    <div class="card-body">

        <form method="POST" enctype="multipart/form-data">

            <div class = "form-group">
            <label for="txtID">Referencia:</label>
            <input type="text" required class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="Id">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre Producto:</label>
            <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
            </div></br>

            <div class = "form-group">
                <label for="txtProveedor">Nombre del Proveedor:</label>
                <select name="txtProveedor" required>
                    <option value="<?php echo $txtProveedor;?>"> <?php echo $txtProveedor;?></option> 
                    <?php
                    include("assets/config/bd.php");
                    $proveedor="SELECT * FROM distribuidor";
                    $resultado= mysqli_query($conexionn,$proveedor);
                    while ($valores = mysqli_fetch_array($resultado)){
                        echo '<option value="'.$valores['nombreDistribuidor'].'">'.$valores['nombreDistribuidor'].'</option>';
                    }                    
                    ?>
                </select>
            </div>

    
             <div class = "form-group">
            <label for="txtPrecio">Cantidad:</label>
            <input type="number" readonly class="form-control" value="<?php echo $txtPrecio; ?>" name="txtCantidad" id="txtCantidad" placeholder="0">
            </div>


            <div class = "form-group">
            <label for="txtPrecio">Precio:</label>
            <input type="number" readonly class="form-control" value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="$0.00">
            </div>


            <div class="form-group">
            <label for="txtCategoria">Categoria:</label>
            <select class="form-control" id="txtCategoria" name="txtCategoria">
                <option><?php echo $txtCategoria;?></option>
                <option>Collares</option>
                <option>Juguetes</option>
                <option>Comida</option>
                <option>Accesorios</option>
            </select>
            </div>

            <div class = "form-group">
            <label for="txtDescripcion">Descripción:</label>
            <textarea type="text" required class="form-control" value="<?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripción"></textarea>
            </div>

            <div class = "form-group">
            <label for="txtImagen">Imagen:</label>
            <br/>

            <?php
                if($txtImagen!=""){
                    
            ?>
            <img class="img-thumbnail rounded" src="assets/img/productos/<?php echo $txtImagen; ?>" width="50" alt="" srcset="">

            <?php } ?>

            <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
            </div>  </br> 


            <div >
                <button type="submit" name="accion" title="Agregar Producto" <?php echo ($accion == "Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                <button type="submit" name="accion" title="Editar Producto" <?php echo ($accion != "Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning"><i class="bi bi-pen-fill"></i></button>
                <button type="submit" name="accion" title="Cancelar selección" <?php echo ($accion != "Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info"><i class="bi bi-x-circle"></i></button>
            </div>


        </form>
        
        </div>   
    </div>  
    <br/>
</div>



<div class="col-md-8">

<table class="table table-bordered">
    <thead>
        <tr>
        </br></br></br></br>
            <th>Ref</th>
            <th>Nombre</th>
            <th>Proveedor</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Descripción</th>
            <th>Imagen</th>            
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php  foreach($listaProductos as $producto){   ?>
        <tr>
            <td><?php echo $producto['idProducto']; ?></td>
            <td><?php echo $producto['nombreProducto']; ?></td>
            <td><?php echo $producto['marcaProducto']; ?></td>
            <td><?php echo $producto['existencia']; ?></td>
            <td><?php echo $producto['precioProducto']; ?></td>
            <td><?php echo $producto['categoriaProducto']; ?></td>
            <td><?php echo $producto['descripcion']; ?></td>
            <td>                
            <img class="img-thumbnail rounded" src="assets/img/productos/<?php echo $producto['imagenProducto']; ?>" width="50" alt="">       
            </td>

            <td>

            <form method="post">
            <div class="btn-group" role="group" aria-label="">
            <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['idProducto']; ?>"/>
            <button type="submit" name="accion" title="Seleccionar Producto" value="Seleccionar" class="btn btn-outline-success"><i class="bi bi-check2-circle"></i></button>
            <button type="submit" name="accion" title="Eliminar Producto" value="Borrar" class="btn btn-secondary" onclick="return confirmacion()"><i class="bi bi-trash3"></i></button>
            </div>
            </form>    
                 
        </td>            
        </tr>
        <?php } ?>
    </tbody>
</table>
 

</div>
</div>
</div>
<?php
include("footer.php");
?>
