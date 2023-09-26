<?php
header ("Content-Type:text/xml");

//ESTE JSON ES PARA HACER PRUEBAS NADA MÁS
$json = 
'{"dVerFor":150,
    "DE":[
        {
            "Id":"47854785478547854785",
            "dDVId":0,
            "dFecFirma":"2020-06-16T00:00:00",
            "dSisFact":5,
            "iTipEmi":1,
            "dDesTipEmi":"Normal",
            "dCodSeg":"123456789",
            "iTiDE":1,
            "dDesTiDE":"Factura electrónica",
            "dNumTim":16032671,
            "dEst":"019",
			"dPunExp":"002",
			"dNumDoc":"0036979",
			"dSerieNum":"AA",
			"dFeIniT":"2022-11-21",
            "dFeEmiDE":"2023-06-16T00:00:00",
            "iTipTra":1,
            "dDesTipTra":"Venta de mercadería",
            "iTImp":1,
            "dDesTImp":"IVA",
            "cMoneOpe":"PYG",
            "dDesMoneOpe":"Guarani",
            "dRucEm":80026165,
            "dDVEmi":8,
            "iTipCont":2,
            "dNomEmi":"Supermercados Pueblo S.A",
            "dNomFanEmi":"Supermercados Pueblo S.A",
            "dDirEmi":"Avda Artigas",
            "dNumCas":0,
            "cDepEmi":1,
            "dDesDepEmi":"CAPITAL",
            "cDisEmi":1,
            "dDesDisEmi":"ASUNCION (DISTRITO)",
            "cCiuEmi":1,
            "dDesCiuEmi":"ASUNCION (DISTRITO)",
            "dTelEmi":300195,
            "dEmailE":"pueblo@grupopueblo.com.py",
            "cActEco":47111,
            "dDesActEco":"COMERCIO AL POR MENOR EN HIPERMERCADOS Y SUPERMERCADOS",
            "iNatRec":1,
            "iTiOpe":2,
            "cPaisRec":"PRY",
            "dDesPaisRe":"Paraguay",
            "iTiContRec":1,
            "dRucRec":2278132,
            "dDVRec":3,
            "dNumIDRec":"2278132-3",
            "dNomRec":"Paulo Villamayor",
            "iIndPres":1,
            "dDesIndPres":"Operación presencial",
            "iCondOpe":1,
            "dDCondOpe":"Contado",
            "iTiPago":3,
            "dDesTiPag":"Tarjeta de crédito",
            "dMonTiPag":81750.00,
            "cMoneTiPag":"PYG",
            "dDMoneTiPag":"Guarani",
            "iDenTarj":99,
            "dDesDenTarj":"Infonet - Debito",
            "iForProPa":1
        }
    ],
    "items":[
        {
            "dCodInt":222459,
            "dDesProSer":"BOLSA 1",
            "cUniMed":77,
            "dDesUniMed":"UNI",
            "dCantProSer":1.000,
            "dPUniProSer":200.000,
            "dTotBruOpeItem":200.0,
            "dDescItem":0,
            "dPorcDesIt":0,
            "dDescGloItem":0,
            "dAntPreUniIt":0,
            "dAntGloPreUniIt":0,
            "dTotOpeItem":200.00,
            "iAfecIVA":1,
            "dDesAfecIVA":"Gravado IVA",
            "dPropIVA":100,
            "dTasaIVA":10,
            "dBasGravIVA":182.00,
            "dLiqIVAItem":18.00
        },
        {
            "dCodInt":222459,
            "dDesProSer":"BOLSA 2",
            "cUniMed":77,
            "dDesUniMed":"UNI",
            "dCantProSer":1.000,
            "dPUniProSer":200.000,
            "dTotBruOpeItem":200.0,
            "dDescItem":0,
            "dPorcDesIt":0,
            "dDescGloItem":0,
            "dAntPreUniIt":0,
            "dAntGloPreUniIt":0,
            "dTotOpeItem":200.00,
            "iAfecIVA":1,
            "dDesAfecIVA":"Gravado IVA",
            "dPropIVA":100,
            "dTasaIVA":10,
            "dBasGravIVA":182.00,
            "dLiqIVAItem":18.00
        },
        {
            "dCodInt":222459,
            "dDesProSer":"BOLSA 3",
            "cUniMed":77,
            "dDesUniMed":"UNI",
            "dCantProSer":1.000,
            "dPUniProSer":200.000,
            "dTotBruOpeItem":200.0,
            "dDescItem":0,
            "dPorcDesIt":0,
            "dDescGloItem":0,
            "dAntPreUniIt":0,
            "dAntGloPreUniIt":0,
            "dTotOpeItem":200.00,
            "iAfecIVA":1,
            "dDesAfecIVA":"Gravado IVA",
            "dPropIVA":100,
            "dTasaIVA":10,
            "dBasGravIVA":182.00,
            "dLiqIVAItem":18.00
        }
    ],
    "gTotSub":[
        {
            "dSubExe":0,
			"dSubExo":0,
			"dSub5":0,
			"dSub10":81750.00000000,
			"dTotOpe":81750.00000000,
			"dTotDesc":0,
			"dTotDescGlotem":0,
			"dTotAntItem":0,
			"dTotAnt":0,
			"dPorcDescTotal":0,
			"dDescTotal":0,
			"dAnticipo":0,
			"dRedon":0,
			"dTotGralOpe":81750.00000000,
			"dIVA5":0,
			"dIVA10":7431.00000000,
			"dLiqTotIVA5":0,
			"dLiqTotIVA10":0,
			"dIVAComi":0,
			"dTotIVA":7431,
			"dBaseGrav5":0,
			"dBaseGrav10":74319.00000000,
			"dTBasGraIVA":74319
        }
    ]
}';

//Obtener el dominio actual
$dominio = $_SERVER['HTTP_HOST'];

//Obtener la carpeta actual (ruta relativa)
$carpetaActual = dirname($_SERVER['REQUEST_URI']);

//URL de destino
$url = $dominio . $carpetaActual . '/de.php'; // Reemplaza esto con la URL a la que deseas enviar el JSON

//Inicializa una sesión cURL
$ch = curl_init($url);

//Configura las opciones de cURL para una solicitud POST con datos JSON
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json)
));

//Captura la respuesta en lugar de imprimirla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Realiza la solicitud cURL y obtén la respuesta
$response = curl_exec($ch);

//Verifica si hubo errores en la solicitud cURL
if (curl_errno($ch)){
    echo 'Error cURL: ' . curl_error($ch);
}

curl_close($ch);

//Maneja la respuesta del servidor
echo $response;
?>