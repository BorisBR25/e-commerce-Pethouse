<?php
include("assets/config/bd.php");
?>

<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtPrecio=(isset($_POST['txtValor']))?$_POST['txtValor']:"";
$txtCompra=(isset($_POST['txtValorCompra']))?$_POST['txtValorCompra']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtCantidad=(isset($_POST['txtCantidad']))?$_POST['txtCantidad']:"";
$txtProveedor=(isset($_POST['txtProveedor']))?$_POST['txtProveedor']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("assets/config/bd.php");

switch($accion){
    //UPDATE pethouse.producto SET marcaProducto=:proveedor, precioProducto=:valor, existencia=:existencia + :cantidad WHERE idProducto=:id
    case "Agregar":
        $sentenciaSQL= $conexion->prepare("INSERT INTO `pethouse`.`compra_producto` (`valorCompra`, `cantidad` ,`idProducto`,`nitDistribuidor`) VALUES (:valor,:cantidad,:idProducto,(SELECT nitDistribuidor FROM pethouse.distribuidor where nombreDistribuidor=:Proveedor));");
        $sentenciaSQL->bindParam(':idProducto',$txtID);
        $sentenciaSQL->bindParam(':valor',$txtCompra);
        $sentenciaSQL->bindParam(':cantidad',$txtCantidad);   
        $sentenciaSQL->bindParam(':Proveedor',$txtProveedor);  

        $sentenciaSQL2= $conexion->prepare("UPDATE `pethouse`.`producto` SET precioProducto=:valor, existencia = existencia + :cantidad WHERE idProducto=:idProducto");
        $sentenciaSQL2->bindParam(':idProducto',$txtID);
        $sentenciaSQL2->bindParam(':valor',$txtPrecio);
        $sentenciaSQL2->bindParam(':cantidad',$txtCantidad);   
       // $sentenciaSQL2->bindParam(':idProveedor',$txtProveedor);

        //multi_query($sentenciaSQL, $sentenciaSQL2);
        $sentenciaSQL->execute();
        $sentenciaSQL2->execute();

        header("Location:CompraProductos.php");
        break;

    case "Cancelar":
        header("Location:CompraProductos.php");
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

        // $sentenciaSQL=$conexion->prepare("SELECT imagenProducto FROM producto WHERE idProducto=:id");
        // $sentenciaSQL->bindParam(':id',$txtID);
        // $sentenciaSQL->execute();
        // $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        // if(isset($producto["imagen"]) && ($producto["imagen"]!="imagen.jpg" )) {
        //     if(file_exists("assets/img/productos/".$producto["imagen"])){
        //         unlink("assets/img/productos/".$producto["imagen"]);

        //     }
        // }
        
        $sentenciaSQL=$conexion->prepare("DELETE FROM compra_producto WHERE idProducto=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        //echo "presionado bonton Borrar";
        header("Location:CompraProductos.php");
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
        var respuesta = confirm("Seguro que desea eliminar el producto de la tienda?");
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
                    Compra de Productos
                </div>

                <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="Referencia">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre Producto:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="">
            </div>


            <div class = "form-group">
            <label for="txtNombre">Nombre del Proveedor:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtProveedor; ?>" name="txtProveedor" id="txtProveedor" placeholder="">
            </div>

            <!-- <div class = "form-group">
                <label for="txtProveedor">Nombre del Proveedor:</label>
                <select required name="txtProveedor">
                    <option disabled>Seleccione el Proveedor:</option>  
                    <?php
                    // include("assets/config/bd.php");
                    // $proveedor="SELECT * FROM pethouse.distribuidor";
                    // $resultado= mysqli_query($conexionn,$proveedor);
                    // while ($valores = mysqli_fetch_array($resultado)){
                    //     echo '<option value="'.$valores['nitDistribuidor'].'">'.$valores['nombreDistribuidor'].'</option>';
                    // }                   
                    ?>
                </select>
            </div> -->

            <div class = "form-group">
                <label for="txtValorCompra">Valor Compra:</label>
                <input type="number" required class="form-control" value="" name="txtValorCompra" id="" placeholder="$0">
            </div>

            <div class = "form-group">
                <label for="txtValor">Valor Venta Actualizado:</label>
                <input type="number" required class="form-control" value="" name="txtValor" id="txtValor" placeholder="$0">
            </div>

            <div class = "form-group">
            <label for="txtCantidad">Cantidad:</label>
            <input type="number" required class="form-control" value="" name="txtCantidad" id="txtCantidad" placeholder="0">
            </div>

            </br> 
            <div >
                <button type="submit" name="accion" title="Agregar info Producto" <?php echo ($accion == "Seleccionar"); ?> value="Agregar" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                
                <button type="submit" name="accion" title="Cancelar selección" <?php echo ($accion != "Seleccionar"); ?> value="Cancelar" class="btn btn-info"><i class="bi bi-x-circle"></i></button>
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
            <th>Nombre Producto</th>
            <th>Proveedor</th>
            <th>Precio Venta</th>
            <th>Existencia</th>
            <th>Categoria</th>
            <th>descripción</th>
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
            <td><?php echo $producto['precioProducto']; ?></td>
            <td><?php echo $producto['existencia']; ?></td>
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
