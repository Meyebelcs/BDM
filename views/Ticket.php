<!-- NOOO HA SIDO PROGRAMADA -->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<?php
session_start();

require_once './components/menu.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    
    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/Ticket.css">


</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

    <div class="container">
            <div class="ticket-container">
            <div class="ticket">
                <div class="ticket-header">
                    Ticket
                </div>
                <br> 
                <br> 
                <br> 
            <p>Fecha: <?php echo date("Y-m-d"); ?></p>
            <p>Hora: <?php echo date("H:i:s");  ?> </p>
            <p><strong>Vendedor</strong></p>
           
                
                <div class="content">
         
           
            <p><strong>Productos</strong></p>
            <div class="divider"></div> <!-- Línea divisoria -->
            <div class="item">
                <span class="concept">Zapatos:</span><span class="value2">(2)</span>
                <span class="value">$60</span>
            </div>
            <div class="item">
                <span class="concept">Audífonos:</span><span class="value2">(1)</span>
                <span class="value">$10</span>
                </div>
                <div class="item">
                <span class="concept">Cuadro:</span><span class="value2">(5)</span>
                <span class="value">$140</span>
            </div>
            <div class="item">
                <span class="concept">Tenis:</span><span class="value2">(1)</span>
                <span class="value">$90</span>
                </div>
            <div class="divider"></div> <!-- Línea divisoria -->

            
            <div class="item">
                <span class="concept2">Subtotal</span>
                <span class="value">$200</span>
                
            </div>
            
            <div class="divider"></div> <!-- Línea divisoria -->
            <div class="item">
                <span class="concept2">Total</span>
                <span class="value">$250</span>
            </div>
            
            <div class="item">
                <span class="concept">Método de pago</span>
                <span class="concept2">Targeta</span>
                <span class="value">$250</span>
            </div>
            
        </div>
        <br> 
        <br> 
        <div>Stock & Custom</div>

    </div>
    
</div>

       
    </div>


    <div class="image">
        <img style="width: 40%; float: right; margin-top: -499px; margin-left: 20px;" src="./css/assets/online-shopping.png" class="img-pay" alt="">
    </div>
   
    <!-- Footer -->
    <?php include('./components/footer.php'); ?>

    <?php include_once "./libs/jqueryJS.php" ?>
    <?php include_once "./libs/bootstrapJS.php" ?>
    <?php include_once "./libs/sweetalertJS.php" ?>
    <script src="./js/Alta_Producto.js"></script>

    </main>

</body>


</html>