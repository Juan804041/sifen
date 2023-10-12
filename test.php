<?php
header ("Content-Type:text/xml");

//ESTE JSON ES PARA HACER PRUEBAS NADA MÁS
$json = 
'{"DE":[
        {
            "dSisFact":1,
            "iTipEmi":1,
            "dDesTipEmi":"Normal",
            "dInfoEmi":1,
            "iTiDE":1,
            "dDesTiDE":"Factura electrónica",
            "dNumTim":12560693,
            "dEst":"001",
            "dPunExp":"001",
            "dNumDoc":"0000004",
            "dFeIniT":"2022-11-21",
            "dFeEmiDE":"2023-10-01T00:00:00",
            "iTipTra":1,
            "dDesTipTra":"Venta de mercadería",
            "iTImp":1,
            "dDesTImp":"IVA",
            "cMoneOpe":"PYG",
            "dDesMoneOpe":"Guarani",
            "dRucEm":80130124,
            "dDVEmi":6,
            "iTipCont":2,
            "dNomEmi":"TracertSystem",
            "dDirEmi":"Salustiano Merardo Moreno esq. jhon Whitehead",
            "dNumCas":1907,
            "cDepEmi":1,
            "dDesDepEmi":"CAPITAL",
            "cDisEmi":1,
            "dDesDisEmi":"ASUNCION (DISTRITO)",
            "cCiuEmi":1,
            "dDesCiuEmi":"ASUNCION (DISTRITO)",
            "dTelEmi":981427733,
            "dEmailE":"paulodvs@gmail.com",
            "cActEco":620,
            "dDesActEco":"ACTIVIDADES DE PROGRAMACIÓN Y CONSULTORÍA INFORMÁTICAS Y OTRAS ACTIVIDADES CONEXAS",
            "iNatRec":1,
            "iTiOpe":2,
            "cPaisRec":"PRY",
            "dDesPaisRe":"Paraguay",
            "iTiContRec":1,
            "dRucRec":2278132,
            "dDVRec":3,
            "dNomRec":"Paulo Villamayor",
            "iIndPres":1,
            "dDesIndPres":"Operación presencial",
            "iCondOpe":1,
            "dDCondOpe":"Contado",
            "iTiPago":3,
            "dDesTiPag":"Tarjeta de crédito",
            "dMonTiPag":600.00,
            "cMoneTiPag":"PYG",
            "dDMoneTiPag":"Guarani",
            "iDenTarj":99,
            "dDesDenTarj":"Infonet - Debito",
            "iForProPa":2
        }
    ],
    "items":[
        {
            "dCodInt":41,
            "dDesProSer":"BOLSA",
            "dCantProSer":1,
            "dPUniProSer":200,
            "dTasaIVA":10
        },
        {
            "dCodInt":52,
            "dDesProSer":"Remera Blanca Mediano",
            "dCantProSer":1,
            "dPUniProSer":15800,
            "dTasaIVA":10
        },
        {
            "dCodInt":63,
            "dDesProSer":"Zapato XL",
            "dCantProSer":1,
            "dPUniProSer":185000,
            "dTasaIVA":10
        }
    ]
}';


include 'sifen.php';

$xml = new sifen();

$retorno = $xml->generar_xml($json, "LocoFactura23", "80130124_6.key", "80130124_6.cer");
//echo $retorno[0]; //Indice 0 es el XML, indice 1 es el npumero de la factura o Id

echo $xml->enviar_xml($retorno[1], "80130124_6_send.key", "80130124_6.cer");
?>