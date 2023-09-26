<?php
header ("Content-Type:text/xml");

//Recibimos el JSON con los datos de la factura
$json = file_get_contents('php://input');

//Converts it into a PHP object
$json_de = json_decode($json, true);

//Generamos los items a ser de la factura
$items = "";
foreach($json_de['items'] as $item){
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
//Recordar luego volver a sacar todos los tabs
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

//Generamos una llave de prueba
//Configuración para la generación de la clave
if (!file_exists('llaves/llave_privada.pem')) { //Comprobamos si la llave ya existe de lo contrario la creamos
	$config = array(
		"private_key_bits" => 2048, //Longitud de bits de la clave privada
		"private_key_type" => OPENSSL_KEYTYPE_RSA //Tipo de clave (RSA en este caso)
	);

	//Generar la clave privada y pública
	$keyPair = openssl_pkey_new($config);

	//Exportar la clave privada a formato PEM y guardarla en un archivo
	$privateKey = '';
	openssl_pkey_export($keyPair, $privateKey, null, $config);
	file_put_contents('llaves/llave_privada.pem', $privateKey);

	//Obtener la clave pública en formato PEM
	$publicKey = openssl_pkey_get_details($keyPair)['key'];

	//Guardar la clave pública en un archivo
	file_put_contents('llaves/llave_publica.pem', $publicKey);
}

//Comenzamos la parte de la firma
//Leer el contenido de la clave pública desde un archivo PEM
$publicKeyPEM = file_get_contents('llaves/80130124_6.pub');

//Elimina las etiquetas BEGIN y END y otros caracteres no deseados
$publicKeyPEM = str_replace(array('-----BEGIN PUBLIC KEY-----', '-----END PUBLIC KEY-----', "\n", "\r", "\r\n"), '', $publicKeyPEM);

//Cargar la clave privada desde un archivo PEM
$keyPass = 'LocoFactura23';
$privateKey = openssl_pkey_get_private(file_get_contents('llaves/80130124_6.key'), $keyPass);

//Lo que se procede a firmar es todo el contenido que ahora está en la variable $xml, una vez firmado ya tiene todos los otros datos salvo el QR

//Cargar el archivo XML que deseas firmar
$xml = new DOMDocument();
$xml->loadXML($xml_crudo);

//Crear un objeto de firma XML
$root = $xml->documentElement;
$signature = $xml->createElementNS('http://www.w3.org/2000/09/xmldsig#', 'Signature');
$root->appendChild($signature);
|
//Crear un objeto de referencia
$reference = $xml->createElement('Reference');
$signature->appendChild($reference);
$reference->setAttribute('URI', $json_de['DE'][0]['Id']);

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
$x509Certificate = $xml->createElement('X509Certificate', $publicKeyPEM);
$x509Data->appendChild($x509Certificate);

//Guardar el XML firmado en un archivo con el Id
$xml->save('de/' . $json_de['DE'][0]['Id'] . '.xml');
$xml = $xml->saveXML();

//Mostramos el nuevo archivo XML
echo $xml;
?>