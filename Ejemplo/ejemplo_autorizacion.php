<?php
    require 'culqi.php';
    
     Culqi::$codigoComercio = "demo";
    Culqi::$llaveSecreta = "JlhLlpOB5s1aS6upiioJkmdQ0OYZ6HLS2+/o4iYO2MQ=";
    Culqi::$servidorBase = 'https://integ-pago.culqi.com';
    
    
    try {
        
        $data = Pago::crearDatospago(array(
                                           
            //Numero de pedido de la venta
            Pago::PARAM_NUM_PEDIDO => rand(5, 10000),
                                           
            //Moneda de la venta ("PEN" O "USD")
            Pago::PARAM_MONEDA => "PEN",
                                           
            //Monto de la venta (ejem: 10.25, va sin el punto decimal)
            Pago::PARAM_MONTO => "100",
                                           
            //Descripción de la venta
            Pago::PARAM_DESCRIPCION => "Venta de prueba.",
                                           
            //Código del país del cliente Ej. PE, US
            Pago::PARAM_COD_PAIS => "PE",
                                           
            //Ciudad del cliente
            Pago::PARAM_CIUDAD => "Lima",
                                           
            //Dirección del cliente
            Pago::PARAM_DIRECCION => "Avenida Lima 2132, Miradores",
                                           
            //Número de teléfono del cliente
            Pago::PARAM_NUM_TEL => "12345678",

            //Correo electrónico del cliente
            "correo_electronico" => "wmuro@me.com",
            
            //Id de usuario del cliente
            "id_usuario_comercio" => "1234567",
            
            //Nombre del cliente
            "nombres" => "William",
            
            //Apellido del cliente
            "apellidos" => "Muro",
                                           
        ));
        
        //Respuesta de la creación de la venta. Cadena cifrada.
        $informacionVenta = $data[Pago::PARAM_INFO_VENTA];
		echo utf8_decode("Información de la venta: $informacionVenta" . "<br/>"."<br/>");

		echo utf8_decode("Codigo de Comercio: " . $data["codigo_comercio"] ."<br/>"."<br/>");
		echo utf8_decode("Número de pedido: " . $data["numero_pedido"] ."<br/>"."<br/>");
		echo utf8_decode("Código de respuesta: " . $data["codigo_respuesta"] ."<br/>"."<br/>");
		echo utf8_decode("Mensaje de respuesta: " . $data["mensaje_respuesta"] ."<br/>"."<br/>");
		echo utf8_decode("Ticket de la venta: " . $data["ticket"] ."<br/>"."<br/>");
		
		   echo utf8_decode("<script src=\"https://integ-pago.culqi.com/api/v1/culqi.js\"></script>
		       <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js\"></script>
			   <button id=\"btn_pago\">Pagar</button>
			   <script>checkout.codigo_comercio = \"demo\";
			            checkout.informacion_venta = \"$informacionVenta\";
						$('#btn_pago').on('click', function(e) {checkout.abrir();e.preventDefault();});
						function culqi (checkout) {
						
						 $.ajax({
								url: \"/ejemplo_descifrado.php\",
								type: \"POST\",
								contentType: \"application/json\",
								data: JSON.stringify(
										{
											'respuesta' : checkout.respuesta
										}),
								success: function(data){
                                console.log(data);
									var obj = JSON.parse(data);
									var respuesta_venta = obj[\"codigo_respuesta\"];
								if (tipo_respuesta_venta == "venta_exitosa") {

                						} else  if (tipo_respuesta_venta == "venta_expirada") {

                						} else  if (tipo_respuesta_venta == "error") {

                						} else  if (tipo_respuesta_venta == "parametro_invalido") {

                						} else {
									
									}
								},
								error:function( ){
								}
							});
						
						// console.log(checkout.respuesta);
						 checkout.cerrar();
						 
						 };
			</script>");
	



    } catch (InvalidParamsException $e) {
        
        echo $e->getMessage()."\n";
        
    }
?>
