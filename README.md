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

# Composición del Archivo JSON a enviar la función generar_xml()
1. Cargar todo el contenido del JSON en una variable y enviarlo, en el ejemplo la variable $json contiene todo lo siguiente
```json
{"DE":[
        {
            "dSisFact":1,
            "iTipEmi":11,
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
}
```