<?php
class sifen{
    /**
     * Esta función genera el xml para ser enviado a la sifen.
     *
     * @param string $json Recibe un string en formato json con todos los datos del archivo xml.
     * @param string $pass_llave_privada Contraseña de la llave privada.
     * @param string $name_llave_privada Nombre completo de la llave privada ubicado dentro de la carpeta llaves.
     * @param string $name_llave_publica Nombre completo de la llave pública ubicado dentro de la carpeta llaves.
     * @param string $codigo_secreto Necesario para la generación del hash del QR y proporcionado por la SIFEN.
     * @param bool $produccion False en el caso de estar en fase de pruebas o test, true en caso de estar ya en producción.
     * @param bool $retornar True para retornar el xml, false si solo se quiere generar en la carpeta de el archivo pero no retornarlo, por defecto retorna.
     * @return string Retorna el xml en un string.
     */
    function generar_xml(string $json, string $pass_llave_privada = "password",  string $name_llave_privada = "privada.key", string $name_llave_publica = "publica.pub", string $codigo_secreto = "ABCD0000000000000000000000000000", bool $produccion = false, bool $retornar = true){
        //Converts it into a PHP object
        $json_de = json_decode($json, true);

        //Generamos los items a ser de la factura
        $items = "";
        $cItems = 0; //Contador de la cantidad de items
        foreach($json_de['items'] as $item){
            $cItems ++; //Sumar 1 por cada item
            $items .= <<<EOF
            <gCamItem>
                <dCodInt>{$item['dCodInt']}</dCodInt>
                <dDesProSer>{$item['dDesProSer']}</dDesProSer>
                <cUniMed>{$item['cUniMed']}</cUniMed>
                <dDesUniMed>{$item['dDesUniMed']}</dDesUniMed>
                <dCantProSer>{$item['dCantProSer']}</dCantProSer>
                <gValorItem>
                    <dPUniProSer>{$item['dPUniProSer']}</dPUniProSer>
                    <dTotBruOpeItem>{$item['dTotBruOpeItem']}</dTotBruOpeItem>
                    <gValorRestaItem>
                        <dDescItem>{$item['dDescItem']}</dDescItem>
                        <dPorcDesIt>{$item['dPorcDesIt']}</dPorcDesIt>
                        <dDescGloItem>{$item['dDescGloItem']}</dDescGloItem>
                        <dAntPreUniIt>{$item['dAntPreUniIt']}</dAntPreUniIt>
                        <dAntGloPreUniIt>{$item['dAntGloPreUniIt']}</dAntGloPreUniIt>
                        <dTotOpeItem>{$item['dTotOpeItem']}</dTotOpeItem>
                    </gValorRestaItem>
                </gValorItem>
                <gCamIVA>
                    <iAfecIVA>{$item['iAfecIVA']}</iAfecIVA>
                    <dDesAfecIVA>{$item['dDesAfecIVA']}</dDesAfecIVA>
                    <dPropIVA>{$item['dDesAfecIVA']}</dPropIVA>
                    <dTasaIVA>{$item['dTasaIVA']}</dTasaIVA>
                    <dBasGravIVA>{$item['dBasGravIVA']}</dBasGravIVA>
                    <dLiqIVAItem>{$item['dLiqIVAItem']}</dLiqIVAItem>
                </gCamIVA>
            </gCamItem>
        EOF;
        }


        //Reemplazamos los datos dentro del modelo XML con los datos enviados
        $xml_crudo = <<<EOF
        <rDE xmlns="http://ekuatia.set.gov.py/sifen/xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://ekuatia.set.gov.py/sifen/xsd siRecepDE_v150.xsd">
            <dVerFor>{$json_de['dVerFor']}</dVerFor>
            <DE Id="{$json_de['DE'][0]['Id']}">
                <dDVId>{$json_de['DE'][0]['dDVId']}</dDVId>
                <dFecFirma>{$json_de['DE'][0]['dFecFirma']}</dFecFirma>
                <dSisFact>{$json_de['DE'][0]['dSisFact']}</dSisFact>
                <gOpeDE>
                    <iTipEmi>{$json_de['DE'][0]['iTipEmi']}</iTipEmi>
                    <dDesTipEmi>{$json_de['DE'][0]['dDesTipEmi']}</dDesTipEmi>
                    <dCodSeg>{$json_de['DE'][0]['dCodSeg']}</dCodSeg>
                </gOpeDE>
                <gTimb>
                    <iTiDE>{$json_de['DE'][0]['iTiDE']}</iTiDE>
                    <dDesTiDE>{$json_de['DE'][0]['dDesTiDE']}</dDesTiDE>
                    <dNumTim>{$json_de['DE'][0]['dNumTim']}</dNumTim>
                    <dEst>{$json_de['DE'][0]['dEst']}</dEst>
                    <dPunExp>{$json_de['DE'][0]['dPunExp']}</dPunExp>
                    <dNumDoc>{$json_de['DE'][0]['dNumDoc']}</dNumDoc>
                    <dSerieNum>{$json_de['DE'][0]['dSerieNum']}</dSerieNum>
                    <dFeIniT>{$json_de['DE'][0]['dFeIniT']}</dFeIniT>
                </gTimb>
                <gDatGralOpe>
                    <dFeEmiDE>{$json_de['DE'][0]['dFeEmiDE']}</dFeEmiDE>
                    <gOpeCom>
                        <iTipTra>{$json_de['DE'][0]['iTipTra']}</iTipTra>
                        <dDesTipTra>{$json_de['DE'][0]['dDesTipTra']}</dDesTipTra>
                        <iTImp>{$json_de['DE'][0]['iTImp']}</iTImp>
                        <dDesTImp>{$json_de['DE'][0]['dDesTImp']}</dDesTImp>
                        <cMoneOpe>{$json_de['DE'][0]['cMoneOpe']}</cMoneOpe>
                        <dDesMoneOpe>{$json_de['DE'][0]['dDesMoneOpe']}</dDesMoneOpe>
                    </gOpeCom>
                    <gEmis>
                        <dRucEm>{$json_de['DE'][0]['dRucEm']}</dRucEm>
                        <dDVEmi>{$json_de['DE'][0]['dDVEmi']}</dDVEmi>
                        <iTipCont>{$json_de['DE'][0]['iTipCont']}</iTipCont>
                        <dNomEmi>{$json_de['DE'][0]['dNomEmi']}</dNomEmi>
                        <dNomFanEmi>{$json_de['DE'][0]['dNomFanEmi']}</dNomFanEmi>
                        <dDirEmi>{$json_de['DE'][0]['dDirEmi']}</dDirEmi>
                        <dNumCas>{$json_de['DE'][0]['dNumCas']}</dNumCas>
                        <cDepEmi>{$json_de['DE'][0]['cDepEmi']}</cDepEmi>
                        <dDesDepEmi>{$json_de['DE'][0]['dDesDepEmi']}</dDesDepEmi>
                        <cDisEmi>{$json_de['DE'][0]['cDisEmi']}</cDisEmi>
                        <dDesDisEmi>{$json_de['DE'][0]['dDesDisEmi']}</dDesDisEmi>
                        <cCiuEmi>{$json_de['DE'][0]['cCiuEmi']}</cCiuEmi>
                        <dDesCiuEmi>{$json_de['DE'][0]['dDesCiuEmi']}</dDesCiuEmi>
                        <dTelEmi>{$json_de['DE'][0]['dTelEmi']}</dTelEmi>
                        <dEmailE>{$json_de['DE'][0]['dEmailE']}</dEmailE>
                        <gActEco>
                            <cActEco>{$json_de['DE'][0]['cActEco']}</cActEco>
                            <dDesActEco>{$json_de['DE'][0]['dDesActEco']}</dDesActEco>
                        </gActEco>
                    </gEmis>
                    <gDatRec>
                        <iNatRec>{$json_de['DE'][0]['iNatRec']}</iNatRec>
                        <iTiOpe>{$json_de['DE'][0]['iTiOpe']}</iTiOpe>
                        <cPaisRec>{$json_de['DE'][0]['cPaisRec']}</cPaisRec>
                        <dDesPaisRe>{$json_de['DE'][0]['dDesPaisRe']}</dDesPaisRe>
                        <iTiContRec>{$json_de['DE'][0]['iTiContRec']}</iTiContRec>
                        <dRucRec>{$json_de['DE'][0]['dRucRec']}</dRucRec>
                        <dDVRec>{$json_de['DE'][0]['dDVRec']}</dDVRec>
                        <dNumIDRec>{$json_de['DE'][0]['dNumIDRec']}</dNumIDRec>
                        <dNomRec>{$json_de['DE'][0]['dNomRec']}</dNomRec>
                    </gDatRec>
                </gDatGralOpe>
                <gDtipDE>
                    <gCamFE>
                        <iIndPres>{$json_de['DE'][0]['iIndPres']}</iIndPres>
                        <dDesIndPres>{$json_de['DE'][0]['dDesIndPres']}</dDesIndPres>
                    </gCamFE>
                    <gCamCond>
                        <iCondOpe>{$json_de['DE'][0]['iCondOpe']}</iCondOpe>
                        <dDCondOpe>{$json_de['DE'][0]['dDCondOpe']}</dDCondOpe>
                        <gPaConEIni>
                            <iTiPago>{$json_de['DE'][0]['iTiPago']}</iTiPago>
                            <dDesTiPag>{$json_de['DE'][0]['dDesTiPag']}</dDesTiPag>
                            <dMonTiPag>{$json_de['DE'][0]['dMonTiPag']}</dMonTiPag>
                            <cMoneTiPag>{$json_de['DE'][0]['cMoneTiPag']}</cMoneTiPag>
                            <dDMoneTiPag>{$json_de['DE'][0]['dDMoneTiPag']}</dDMoneTiPag>
                            <gPagTarCD>
                                <iDenTarj>{$json_de['DE'][0]['iDenTarj']}</iDenTarj>
                                <dDesDenTarj>{$json_de['DE'][0]['dDesDenTarj']}</dDesDenTarj>
                                <iForProPa>{$json_de['DE'][0]['iForProPa']}</iForProPa>
                            </gPagTarCD>
                        </gPaConEIni>
                    </gCamCond>
                    $items
                </gDtipDE>
                <gTotSub>
                    <dSubExe>{$json_de['gTotSub'][0]['dSubExe']}</dSubExe>
                    <dSubExo>{$json_de['gTotSub'][0]['dSubExo']}</dSubExo>
                    <dSub5>{$json_de['gTotSub'][0]['dSub5']}</dSub5>
                    <dSub10>{$json_de['gTotSub'][0]['dSub10']}</dSub10>
                    <dTotOpe>{$json_de['gTotSub'][0]['dTotOpe']}</dTotOpe>
                    <dTotDesc>{$json_de['gTotSub'][0]['dTotDesc']}</dTotDesc>
                    <dTotDescGlotem>{$json_de['gTotSub'][0]['dTotDescGlotem']}</dTotDescGlotem>
                    <dTotAntItem>{$json_de['gTotSub'][0]['dTotAntItem']}</dTotAntItem>
                    <dTotAnt>{$json_de['gTotSub'][0]['dTotAnt']}</dTotAnt>
                    <dPorcDescTotal>{$json_de['gTotSub'][0]['dPorcDescTotal']}</dPorcDescTotal>
                    <dDescTotal>{$json_de['gTotSub'][0]['dDescTotal']}</dDescTotal>
                    <dAnticipo>{$json_de['gTotSub'][0]['dAnticipo']}</dAnticipo>
                    <dRedon>{$json_de['gTotSub'][0]['dRedon']}</dRedon>
                    <dTotGralOpe>{$json_de['gTotSub'][0]['dTotGralOpe']}</dTotGralOpe>
                    <dIVA5>{$json_de['gTotSub'][0]['dIVA5']}</dIVA5>
                    <dIVA10>{$json_de['gTotSub'][0]['dIVA10']}</dIVA10>
                    <dLiqTotIVA5>{$json_de['gTotSub'][0]['dLiqTotIVA5']}</dLiqTotIVA5>
                    <dLiqTotIVA10>{$json_de['gTotSub'][0]['dLiqTotIVA10']}</dLiqTotIVA10>
                    <dIVAComi>{$json_de['gTotSub'][0]['dIVAComi']}</dIVAComi>
                    <dTotIVA>{$json_de['gTotSub'][0]['dTotIVA']}</dTotIVA>
                    <dBaseGrav5>{$json_de['gTotSub'][0]['dBaseGrav5']}</dBaseGrav5>
                    <dBaseGrav10>{$json_de['gTotSub'][0]['dBaseGrav10']}</dBaseGrav10>
                    <dTBasGraIVA>{$json_de['gTotSub'][0]['dTBasGraIVA']}</dTBasGraIVA>
                </gTotSub>
            </DE>
        </rDE>
        EOF;

        //Comenzamos la parte de la firma
        //Leer el contenido de la clave pública desde un archivo .PUB
        $publicKeyPUB = file_get_contents(__DIR__ . '/llaves/' . $name_llave_publica);

        //Elimina las etiquetas BEGIN y END y otros caracteres no deseados
        $publicKeyPUB = str_replace(array('-----BEGIN PUBLIC KEY-----', '-----END PUBLIC KEY-----', "\n", "\r", "\r\n"), '', $publicKeyPUB);

        //Cargar la clave privada desde un archivo PEM
        $keyPass = $pass_llave_privada;
        $privateKey = openssl_pkey_get_private(file_get_contents(__DIR__ . '/llaves/' . $name_llave_privada), $keyPass);

        //Lo que se procede a firmar es todo el contenido que ahora está en la variable $xml, una vez firmado ya tiene todos los otros datos salvo el QR

        //Cargar el archivo XML que deseas firmar
        $xml = new DOMDocument();
        $xml->loadXML($xml_crudo);

        //Crear un objeto de firma XML
        $root = $xml->documentElement;
        $signature = $xml->createElementNS('http://www.w3.org/2000/09/xmldsig#', 'Signature');
        $root->appendChild($signature);

        //Crear un objeto de referencia
        $reference = $xml->createElement('Reference');
        $signature->appendChild($reference);
        $reference->setAttribute('URI', '#' . $json_de['DE'][0]['Id']);

        //Crear el objeto de transformación
        $transforms = $xml->createElement('Transforms');
        $reference->appendChild($transforms);
        $transform = $xml->createElement('Transform');
        $transforms->appendChild($transform);
        $transform->setAttribute('Algorithm', 'http://www.w3.org/2000/09/xmldsig#enveloped-signature');

        //Crear el objeto DigestMethod
        $digestMethod = $xml->createElement('DigestMethod');
        $reference->appendChild($digestMethod);
        $digestMethod->setAttribute('Algorithm', 'http://www.w3.org/2001/04/xmlenc#sha256');

        //Calcular el valor de DigestValue (hash del contenido)
        $digestValue = base64_encode(sha1($xml->C14N(), true));
        $digestValueElement = $xml->createElement('DigestValue', $digestValue);
        $reference->appendChild($digestValueElement);

        //Firmar el XML
        openssl_sign($xml->C14N(), $signatureValue, $privateKey, OPENSSL_ALGO_SHA256);

        //Codificar la firma en base64 y establecerla como el valor de SignatureValue
        $signatureValueElement = $xml->createElement('SignatureValue', base64_encode($signatureValue));
        $signature->appendChild($signatureValueElement);

        //Crear el objeto KeyInfo
        $keyInfo = $xml->createElement('KeyInfo');
        $signature->appendChild($keyInfo);

        //Crear el objeto X509Data
        $x509Data = $xml->createElement('X509Data');
        $keyInfo->appendChild($x509Data);

        //Crear el objeto X509Certificate y establecer el valor del certificado
        $x509Certificate = $xml->createElement('X509Certificate', $publicKeyPUB);
        $x509Data->appendChild($x509Certificate);

        //Crear el objeto para el QR
        $gCamFuFD = $xml->createElement('gCamFuFD');
        $root->appendChild($gCamFuFD);

        //Creación del HASH del QR
        $concatenado = "nVersion=150&Id=" . $json_de['DE'][0]['Id'] . "&dFeEmiDE=" . bin2hex($json_de['DE'][0]['dFeEmiDE']) . "&dRucRec=" . $json_de['DE'][0]['dRucRec'] . "&dTotGralOpe=" . $json_de['gTotSub'][0]['dTotGralOpe'] . "&dTotIVA=" . $json_de['gTotSub'][0]['dTotIVA'] . "&cItems=" . $cItems . "&DigestValue=" . bin2hex($digestValue) . "&IdCSC=0001";
        $concat_mas_codigo = $concatenado . $codigo_secreto;
        $hash_qr = hash('sha256', $concat_mas_codigo);

        //Crear un objeto de referencia al código QR
        if($produccion){
            $enlaceQR = "https://ekuatia.set.gov.py/consultas/qr?" . $concatenado . "&cHashQR=" . $hash_qr;
        }else{
            $enlaceQR = "https://www.ekuatia.set.gov.py/consultas-test/qr?" . $concatenado . "&cHashQR=" . $hash_qr;
        }
        
        $enlace_qr_cambio = str_replace("&","&amp;",$enlaceQR); //Antes de la inserción de la URL en el XML, se deberá reemplazar los símbolos “&” por su equivalente en código html, el cual es “&amp;”.
        $dCarQR = $xml->createElement('dCarQR', $enlace_qr_cambio); 
        $gCamFuFD->appendChild($dCarQR);

        //Generamos el QR para poder usar en la impresión
        //Librería usada para generar el QR https://github.com/kreativekorp/barcode
        include 'lib/barcode-master/barcode.php';
        $generator = new barcode_generator();
        /* Create bitmap image and write to file. */
        $image = $generator->render_image("qr", $enlaceQR,"");
        $filename = __DIR__ . '/de/' . $json_de['DE'][0]['Id'] . '.png';
        imagepng($image, $filename);
        imagedestroy($image);

        //Guardar el XML firmado en un archivo con el Id
        $xml->save(__DIR__ . '/de/' . $json_de['DE'][0]['Id'] . '.xml');
        $xml = $xml->saveXML();

        if($retornar){
            //Mostramos el nuevo archivo XML
            return $xml;
        }
    }


    /**
     * Esta función envia el xml a la SIFEN.
     *
     * @param string $num_xml Recibe un string en formato json con todos los datos del archivo xml.
     * @param string $name_llave_privada Nombre completo de la llave privada ubicado dentro de la carpeta llaves.
     * @param string $name_certificado Nombre completo del certificado ubicado dentro de la carpeta llaves.
     * @param bool $retornar True para retornar el xml de la sifen, false en caso de no importar lo que retorna.
     * @param bool $produccion False en el caso de estar en fase de pruebas o test, true en caso de estar ya en producción.
     * @return string Retorna el xml devulto por la SIFEN en un string.
     */
    function enviar_xml(string $num_xml, string $name_llave_privada, string $name_certificado, bool $produccion = false, bool $retornar = true){
        //Enviamos el archivo al servidor de prueba de la SIFEN
        //Ruta al archivo XML que deseas enviar
        $rutaArchivoXML = __DIR__ . '/de/' . $num_xml . '.xml';

        //URL de destino donde deseas enviar el archivo
        if($produccion){
            $urlDestino = 'https://sifen.set.gov.py/de/ws/sync/recibe.wsdl?wsdl';
        }else{
            $urlDestino = 'https://sifen-test.set.gov.py/de/ws/sync/recibe.wsd?wsdl';
        }

        //Ruta al archivo de clave privada correspondiente al certificado
        $rutaClavePrivada = __DIR__ . '/llaves/' . $name_llave_privada;

        //Contraseña de la clave privada (si es necesaria)
        //$contrasenaClavePrivada = 'password';

        //Ruta al archivo de certificado en formato .crt
        $rutaCertificado = __DIR__ . '/ llaves/' . $name_certificado;

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

        //Ruta donde deseas guardar el archivo XML
        $rutaArchivo = __DIR__ . '/de/' . $num_xml . '_respuesta_sifen.xml';

        //Guardar el contenido XML de la SIFEN en el archivo
        file_put_contents($rutaArchivo, $response);

        //Verifica si hubo errores en la solicitud cURL
        if (curl_errno($ch)){
            return curl_error($ch);
        }

        //Cierra la sesión cURL
        curl_close($ch);

        //Maneja la respuesta del servidor si es necesario
        if ($response) {
            return $response;
        }
    }

    /**
     * Esta función obtiene la hora actual del servidor aravo1.set.gov.py de la SET.
     * 
     * @param bool $crudo True para retornar la hora cruda del servidor, luego se debe de trasformar en una hora legible, false en caso de querer retornar "Y-m-d H:i:s".
     * @return string Retorna la fecha y la hora exacta del servidor de la SET.
     */
    function aravo(bool $crudo = false){
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

        if($crudo){
            return $timestamp;
        }else{
            return $fecha_hora;
        }
    }
}