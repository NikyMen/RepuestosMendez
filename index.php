<?php

include "global/config.php";
include "global/conexion.php";
include "carrito.php";
include "templates/cabecera.php";

?>
 
<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <div class="container">
        <br>
        <?php if($mensaje!=""){?>
        <div class="alert alert-success">
            
            <?php echo $mensaje;?> 
            <a href="mostrarcarrito.php" class="badge badge-success">ver carrito</a>           
        </div>
        <?php } ?>
        <div class="row">
           
        <?php
        
            $sentencia=$pdo->prepare("SELECT * FROM `tblproductos`");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listaProductos);

        ?>
        <?php foreach($listaProductos as $producto): ?>

            <div class="col-3">
            <div class="card">
                <img 
                
                data-toggle="popover" 
                data-content="<?php echo $producto["Descripcion"]; ?>"
                class="card-img-top" 
                src="<?php echo $producto["Imagen"]; ?>" 
                alt="<?php echo $producto["Nombre"]; ?>"
                data-trigger="hover focus"
                height="317px" 
                >
                <div class="card-body">
                <h5 class="card-title">$<?php echo $producto["Precio"]; ?></h5>
                <p class="card-text"><?php echo $producto["Nombre"]; ?></p>

            <form action="" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'],COD,KEY);?>">
            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'],COD,KEY);?>">
            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">

                <button class="btn btn-primary" type="submit" 
                name="btnAccion" 
                value="Agregar">Agregar al carrito
                </button>
            </form>
                </div>
            </div>
            </div>
            

        <?php endforeach; ?>
        
    


            
           

    
    
    <script src="js/popover-init.js"></script>

<?php include "templates/pie.php"; ?>