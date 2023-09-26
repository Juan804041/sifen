<?php
$ntp_server = 'aravo1.set.gov.py';
$port = 123; //Puerto estándar para NTP

//Formatea el paquete de solicitud NTP (protocolo NTP)
$request_packet = "\x1b" . str_repeat("\0", 47);

//Crea un socket UDP
$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
if ($socket === false) {
    echo "Error al crear el socket: " . socket_strerror(socket_last_error());
    exit();
}

//Establece un tiempo de espera para el socket (en segundos)
socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, ['sec' => 5, 'usec' => 0]);

//Conecta al servidor NTP
if (socket_connect($socket, $ntp_server, $port) === false) {
    echo "Error al conectar al servidor NTP: " . socket_strerror(socket_last_error());
    exit();
}

//Envía la solicitud al servidor NTP
if (socket_send($socket, $request_packet, strlen($request_packet), 0) === false) {
    echo "Error al enviar la solicitud al servidor NTP: " . socket_strerror(socket_last_error());
    exit();
}

//Recibe la respuesta del servidor NTP
if (socket_recv($socket, $response_packet, 48, 0) === false) {
    echo "Error al recibir la respuesta del servidor NTP: " . socket_strerror(socket_last_error());
    exit();
}

//Cierra el socket
socket_close($socket);

//Analiza la respuesta NTP para obtener el timestamp
$unpack_response = unpack("N12", $response_packet);
$timestamp = sprintf("%.0f", ($unpack_response[9] - 2208988800));

//Convierte el timestamp a una fecha y hora legible
$fecha_hora = date("Y-m-d H:i:s", $timestamp);

echo "La hora actual del servidor NTP {$ntp_server} es: {$fecha_hora}";
?>