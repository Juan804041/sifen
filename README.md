# sifen V: 0.4.0
CLASE de Conexión y Generación de Factura de la SET/SIFEN Paraguay

Aquí iremos actualizando todo lo que se pueda sobre el sistema de facturación de la SIFEN y esta nueva CLASE con todo lo necesario.

Hasta el momento se puede ver el código y cualquier mejora que se necesite bienvenido sea las sugerencias.
De momento hago una pequeña descripción de la clase

# Notas:
Se debe crear una carpeta llaves dentro de la cual se deberá meter las llaves necesarias para el funcionamiento de la de la clase

# Modo de USO de las librerías:
1. Se incluye la librería sifen.php
2. Se crear un objeto de la clase
3. Se Genera un archivo xml enviado los datos necesarios en formato JSON al objeto con la función generar_xml()
4. Se devuelve un array con el indice 0 con el archivo XML generado y firmado y en el indice 1 el Id del documento
5. Se procede a enviar el documento generado anteriormente colocando el número de Id devuelto en el array
6. Se guarda de manera automática lo devuelto por los servidores de la SIFEN dentro de la carpeta de/ donde se encuentra la clase

# Necesidades de PHP
1. En el archivo ini.php o en su servidor habilitar openssl para todo lo referente a la firma
2. Para la utilización de aravo.php se debe habilitar socket

# Ayudas
1. Si necesitan alguna ayuda con la implementación de la misma pueden contactar con PAULO DANIEL VILLAMAYOR al +595 992 625873 Tracertsystem
2. O Juan Zamphirópolos +595 961 804041

# sifen.php
El archivo sifen.php ya es una clase en si misma.
Se lo puede incluir directamente en su proyecto y hacer llamada directa

```php

include 'sifen.php'; //Incluimos la librería
$xml = new sifen(); //Creamos un objeto de la clase sifen
$arreglo = $xml->generar_xml($json, "contraseña", "llave_privada.key", "certificado.cer"); //Llamamos a la función generar_xml enviando los parametros a ser usados
$xml->enviar_xml($arreglo[1],'llave_privada_abierta.key','certificado.cer'); //Llamamos a la función para enviar el archivo a la SIFEN
```