
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/carritoCSS.css">
    <title>Pasarela de pago</title>
</head>
<body>
    
    <header>
        <div class="row">
            <div class="col">
                <h1>PASARELA DE PAGO</h1> <!--clave paypal = Clavepaypal123-->
            </div>
            <div class="col">
                <button type="button" class="btn btn-success position-absolute end-0 "  id="devolverse">Atras<button>
            </div>

        </div>
    </header>

    <script src="https://www.paypal.com/sdk/js?client-id=AZdeHoyF0kM1gaobCz9-45hmxs56i3o_cplYaeoAIAc_RQxZdESygZI1NNYZARti3uaOi9hmAJc9ay9N&currency=USD"> // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>

    <div class="row container-fluid">
        <div class="col-md-6">
            <form id="formulario" action="registroUsuarioTienda.php" method="post" enctype="multipart/form-data" >

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="input-nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" id="" placeholder="Ingrese su nombre" required>
                    </div>
                    <div class="col-md-6">
                        <label for="input-apellido">Apellido:</label>
                        <input type="text" name="apellido" class="form-control" id="" placeholder="Ingrese su apellido">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="input-nombre">Documento Identidad:</label>
                        <input type="number" name="id" class="form-control" id="" placeholder="Ingrese su documento" required>
                    </div>
                    <div class="col-md-6">
                        <label for="input-apellido">Correo Electrónico:</label>
                        <input type="email" name="correo" class="form-control" id="" placeholder="email@dominio.com" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="">Tipo de Calle:</label>
                        <select name="direccion1" class="form-control" required>
                            <option value="" ></option>
                              <option value="Calle">Calle</option>
                              <option value="Carrera">Carrera</option>
                              <option value="Avenida">Avenida</option>
                              <option value="Circular">Circular</option>
                              <option value="Diagonal">Diagonal</option>
                              <option value="Tranversal">Tranversal</option>
                              </select>
                        </div>
                    <div class="col-md-3">
                        <label>Número:</label>
                        <input type="text" name="direccion2" class="form-control" id="" placeholder="Ingrese el número"   >
                    </div>
                    <div class="col-md-3">
                        <label>#</label>
                        <input type="text" name="direccion3" class="form-control" id="" placeholder="Ingrese número de cruce" required>
                    </div>
                    <div class="col-md-3">
                        <label>Número:</label>
                        <input type="text" name="direccion4" class="form-control" id="" placeholder="Distancia">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="input-ciudad">Ciudad:</label>
                        <select name="ciudad" class="form-control" required>
                            <option value=""></option>
                              <option value="Medellín">Medellín</option>
                              <option value="Envigado">Envigado</option>
                              <option value="Itaguí">Itaguí</option>
                              <option value="Itaguí">Sabaneta</option>
                              <option value="Bello">Bello</option>
                              </select>
                        </div>
                    <div class="col-md-6">
                        <label for="input-provincia">Barrio:</label>
                        <input type="text" name="barrio" class="form-control" id="" placeholder="Ingrese nombre barrio">
                    </div>
                </div><br><br>
                <button type="submit" id="enviar-btn" class="btn btn-success">Enviar</button>
            </form>
        </div>
        <div class="container col-md-6 pagoContenidoCarrito">

            <div class="total-titulo">Total: <span class="precio-total"></span></div>
            
        </div>
        </div>
    </div>
    </div><br><br><br>
        <div>
        <div class="col-md-6">
        <div id="paypal-button-container"></div>
        </div>
    </div>
</div>

    <script>
        const cartItems = JSON.parse(localStorage.getItem('payInfo'));
        const totalprice = parseInt(cartItems[0].total.replace("$",""))
        
        
        paypal.Buttons({
            style:{
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: totalprice
                        }
                    }]
                });
            },
            onApprove: function(data, actions){
                let datosProducto = localStorage.getItem('payInfo');
                let idValue = document.querySelector("[name='id']").value;
                console.log(idValue);
                    fetch('datospedido.php', {
                    method: 'POST',
                    body: JSON.stringify({ datos: datosProducto, id: idValue })
                    });

                actions.order.capture().then(function(detalles){
                    console.log(detalles);
                    alert('¡Pago completado con exito!')
                    
                    fetch('../PetHouse-main/capturaPago.php',{
                        method: 'POST',
                        body: JSON.stringify({detalles: detalles})
                    })
                    localStorage.clear();
                    window.location.href = 'index.php';
                    
                });
            },
            onCancel: function(data){
                alert("PAGO CANCELADO");
            }
        }).render('#paypal-button-container');
        
    </script>
    <script>
            document.getElementById('formulario').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita la acción por defecto del formulario
        
        // Obtén los datos del formulario
            var formData = new FormData(this);
        
        // Realiza una solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', this.action, true);
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText); // Muestra la respuesta del servidor en la consola
            }
        };
        xhr.send(formData);
        alert("SE REGISTRARON TUS DATOS CON EXITO!")
    });
    </script>
    <script>
        document.getElementById('devolverse').addEventListener('click', function(){
            localStorage.removeItem('payInfo');
            window.location.href = 'index.php';
        })
    </script>
    <script src="../PetHouse/assets/js/payContent.js"></script>
</body>
</html>