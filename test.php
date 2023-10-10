<?php
header ("Content-Type:text/xml");

//ESTE JSON ES PARA HACER PRUEBAS NADA MÁS
$json = 
'{"dVerFor":150,
    "DE":[
        {
            "dSisFact":5,
            "iTipEmi":1,
            "dDesTipEmi":"Normal",
            "dInfoEmi":1,
            "iTiDE":1,
            "dDesTiDE":"Factura electrónica",
            "dNumTim":16032671,
            "dEst":"019",
			"dPunExp":"002",
			"dNumDoc":"0036979",
			"dFeIniT":"2022-11-21",
            "dFeEmiDE":"2023-10-01T00:00:00",
            "iTipTra":1,
            "dDesTipTra":"Venta de mercadería",
            "iTImp":1,
            "dDesTImp":"IVA",
            "cMoneOpe":"PYG",
            "dDesMoneOpe":"Guarani",
            "dRucEm":80026165,
            "dDVEmi":8,
            "iTipCont":1,
            "dNomEmi":"Supermercados Pueblo S.A",
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
            "iForProPa":2
        }
    ],
    "items":[
        {
            "dDesProSer":"BOLSA 1",
            "dCantProSer":1,
            "dPUniProSer":200
        },
        {
            "dDesProSer":"BOLSA 2",
            "dCantProSer":1,
            "dPUniProSer":200
        },
        {
            "dDesProSer":"BOLSA 3",
            "dCantProSer":1,
            "dPUniProSer":200
        }
    ]
}';


include 'sifen.php';

$xml = new sifen();

$retorno = $xml->generar_xml($json, "LocoFactura23", "80130124_6.key", "80130124_6.cer");
//echo $retorno[0]; //Indice 0 es el XML, indice 1 es el npumero de la factura o Id

echo $xml->enviar_xml($retorno[1], "80130124_6_send.key", "80130124_6.cer");
?>