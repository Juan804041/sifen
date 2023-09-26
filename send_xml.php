<?php
//Enviamos el archivo al servidor de prueba de la SIFEN
//Ruta al archivo XML que deseas enviar
$rutaArchivoXML = 'de/' . $_GET['xml_file'] . '.xml';
//$rutaArchivoXML = 'de/1921236549852587959.xml';

//URL de destino donde deseas enviar el archivo
$urlDestino = 'https://sifen-test.set.gov.py/de/ws/sync/recibe.wsd?wsdl';

//Ruta al archivo de certificado en formato .crt
//$rutaCertificado = getcwd(). '/paulo/80130124_6.cer';
$rutaCertificado = 'llaves/80130124_6.cer';

//Ruta al archivo de clave privada correspondiente al certificado
//$rutaClavePrivada = getcwd(). '/paulo/80130124_6.key';
$rutaClavePrivada = 'llaves/80130124_6_send.key';

//Contraseña de la clave privada (si es necesaria)
//$contrasenaClavePrivada = 'LocoFactura23';

//Inicializa una sesión cURL
$ch = curl_init();

//Configura la URL de destino
curl_setopt($ch, CURLOPT_URL, $urlDestino);

//Habilita la opción POST para enviar datos
curl_setopt($ch, CURLOPT_POST, true);

//Configura el archivo XML para ser enviado
$xmlData = file_get_contents($rutaArchivoXML);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);

//Establece la cabecera Content-Type para el XML
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));

//Configura el certificado y la clave privada para la autenticación
curl_setopt($ch, CURLOPT_SSLCERT, $rutaCertificado);
curl_setopt($ch, CURLOPT_SSLKEY, $rutaClavePrivada);

//Establece la contraseña de la clave privada (si es necesaria)
//curl_setopt($ch, CURLOPT_SSLKEYPASSWD, $contrasenaClavePrivada);

//Habilita la verificación del certificado del servidor
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

//Configura la ruta al archivo de la CA raíz (si es necesario)
//curl_setopt($ch, CURLOPT_CAINFO, 'ruta/a/la/ca-raiz.crt');

//Configura para recibir una respuesta del servidor (opcional)
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Ejecuta la solicitud cURL
$response = curl_exec($ch);

//Verifica si hubo errores en la solicitud cURL
if (curl_errno($ch)){
    echo 'Error cURL: ' . curl_error($ch);
}

//Cierra la sesión cURL
curl_close($ch);

//Maneja la respuesta del servidor si es necesario
if ($response) {
    echo 'Respuesta del servidor: ' . $response;
}
?>