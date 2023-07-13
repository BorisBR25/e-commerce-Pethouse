<?php

include("assets/config/bd.php");

?>

<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtTel=(isset($_POST['txtTel']))?$_POST['txtTel']:"";
$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
$txtMunicipio=(isset($_POST['txtMunicipio']))?$_POST['txtMunicipio']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("assets/config/bd.php");

//INSERT INTO `sitio`.`proveedor` (`nombreProveedor`, `telProveedor`, `correoProveedor`, `DireccionProveedor`) VALUES ('pedigree', '312000000', 'pedigree@', 'cra 30');

switch($accion){

    case "Agregar":
        $sentenciaSQL= $conexion->prepare("INSERT INTO `pethouse`.`distribuidor` (`nitDistribuidor`, `nombreDistribuidor`, `telefonoDistribuidor`, `correoDistribuidor`, `direccionDistribuidor`,`municipioDistribuidor`) VALUES (:id,:nombre,:tel,:correo,:direccion,:municipio);");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':tel',$txtTel);
        $sentenciaSQL->bindParam(':correo',$txtCorreo);   
        $sentenciaSQL->bindParam(':direccion',$txtDireccion);
        $sentenciaSQL->bindParam(':municipio',$txtMunicipio);
        $sentenciaSQL->execute();

        header("Location:proveedores.php");
        break;

    case "Modificar":

        $sentenciaSQL=$conexion->prepare("UPDATE `pethouse`.`distribuidor` SET nombreDistribuidor=:nombre, telefonoDistribuidor=:tel, correoDistribuidor=:correo, direccionDistribuidor=:direccion, municipioDistribuidor=:municipio WHERE nitDistribuidor=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':tel',$txtTel);
        $sentenciaSQL->bindParam(':correo',$txtCorreo);   
        $sentenciaSQL->bindParam(':direccion',$txtDireccion);  
        $sentenciaSQL->bindParam(':municipio',$txtMunicipio);
        $sentenciaSQL->execute();
        
        //echo "presionado boton modificar";
        header("Location:proveedores.php");
        break;

    case "Cancelar":
        header("Location:proveedores.php");
       // echo "presionado bonton cancelar";
        break;

    case "Seleccionar":

        $sentenciaSQL=$conexion->prepare("SELECT * FROM distribuidor WHERE nitDistribuidor=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $distribuidor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
        $txtNombre=$distribuidor['nombreDistribuidor'];
        $txtTel=$distribuidor['telefonoDistribuidor'];
        $txtCorreo=$distribuidor['correoDistribuidor'];
        $txtDireccion=$distribuidor['direccionDistribuidor'];
        $txtMunicipio=$distribuidor['municipioDistribuidor'];
        
        //echo "presionado bonton Seleccionar";
    
        break;
        
    case "Borrar":
        
        $sentenciaSQL=$conexion->prepare("DELETE FROM distribuidor WHERE nitDistribuidor=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
       // $sentenciaSQL->execute();

        try{
            $sentenciaSQL->execute();
             
        }
        catch(Exception $e){
              //mostramos el texto del error al usuario	  
            $x = substr($e, 23, 5);  
            //echo $x; echo $dic=8/0;
                if ($x == "23000" ){                    
                    echo '<script> alert("Debe borrar los producto del proveedor para eliminarlo por completo");window.location.href="productos.php"</script>';                  
                }
        break;
        }
        //echo "presionado bonton Borrar";
        header("Location:proveedores.php");

        break;
    }

$sentenciaSQL=$conexion->prepare("SELECT * FROM pethouse.distribuidor");
$sentenciaSQL->execute();
$listaDistribuidor=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


//print_r($_POST);
//print_r($_FILES);
//print_r($listaLibros);
?>
<?php
include("headerAdmin.php");
?>

<script type="text/javascript">
    function confirmacion(){
        var respuesta = confirm("Seguro que desea eliminar el proveedor?");
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
            Datos del Proveedor
        </div>

        <div class="card-body">

        <form method="POST" enctype="multipart/form-data">

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required  class="form-control" value="<?php echo $txtID; ?>"  name="txtID" id="txtID" placeholder="NIT" <?php echo ($accion == "Seleccionar")?"readonly":""; ?> >
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre Proveedor:</label>
            <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
            </div>

            <div class = "form-group">
            <label for="txtTel">Teléfono Proveedor:</label>
            <input type="number" required class="form-control" value="<?php echo $txtTel; ?>" name="txtTel" id="txtTel" placeholder="">
            </div>

            <div class = "form-group">
            <label for="txtCorreo">Correo:</label>
            <input type="email" required class="form-control" value="<?php echo $txtCorreo; ?>" name="txtCorreo" id="txtPrecio" placeholder="@">
            </div>

            <div class = "form-group">
            <label for="txtDireccion">Dirección:</label>
            <input type="text" required class="form-control" value="<?php echo $txtDireccion; ?>" name="txtDireccion" id="txtDireccion" placeholder="">
            </div> 

            <div class = "form-group">
            <label for="txtMunicipio">Municipio:</label>
            <input type="text" required class="form-control" value="<?php echo $txtMunicipio; ?>" name="txtMunicipio" id="txtMunicipio" placeholder="">
            </div>
            </br>    

            <div>
                <button type="submit" name="accion" title="Agregar Proveedor" <?php echo ($accion == "Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                <button type="submit" name="accion" title="Editar Proveedor" <?php echo ($accion != "Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning"><i class="bi bi-pen-fill"></i></button>
                <button type="submit" name="accion" title="Cancelar selección" <?php echo ($accion != "Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info"><i class="bi bi-x-circle"></i></button>
            </div>

        </form>
        </div>   
    </div>          
</div>

<div class="col-md-7">

<table class="table table-bordered">
    <thead>
        <tr></br></br></br></br>
            <th>ID</th>
            <th>Nombre Proveedor</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th> 
            <th>Municipio</th>           
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php  foreach($listaDistribuidor as $distribuidor){   ?>
        <tr>
            <td><?php echo $distribuidor['nitDistribuidor']; ?></td>
            <td><?php echo $distribuidor['nombreDistribuidor']; ?></td>
            <td><?php echo $distribuidor['telefonoDistribuidor']; ?></td>
            <td><?php echo $distribuidor['correoDistribuidor']; ?></td>
            <td><?php echo $distribuidor['direccionDistribuidor']; ?></td>
            <td><?php echo $distribuidor['municipioDistribuidor']; ?></td>  

            <td>

            <form method="post">
            <div class="btn-group" role="group" aria-label="">
            <input type="hidden" name="txtID" id="txtID" value="<?php echo $distribuidor['nitDistribuidor']; ?>"/>
            <button type="submit" name="accion" title="Seleccionar Proveedor" value="Seleccionar" class="btn btn-outline-success"><i class="bi bi-check2-circle"></i></button>
            <button type="submit" name="accion" title="Eliminar Proveedor" value="Borrar" class="btn btn-secondary" onclick="return confirmacion()"><i class="bi bi-trash3"></i></button>

            </form>    
                 
            </td>          

        </tr>
        <?php } ?>
    </tbody>
</table> 
        </div>   
    </div>
</div>
</br>
<?php
include("footer.php");
?>

