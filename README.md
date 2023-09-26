# sifen
API de Conexión y Generación de Factura de la SET/SIFEN Paraguay

Aquí iremos actualizando todo lo que se pueda sobre el sistema de facturación de la SIFEN y esta nueva API con todo lo necesario.

Hasta el momento se puede ver el código y cualquier mejora que se necesite bienvenido sea las sugerencias.
De momento hago una pequeña descripción de los archivos

# Notas:
Se debe crear una carpeta llaves dentro de la cual se deberá meter las llaves necesarias para el funcionamiento de la api

# Modo de USO de las librerías:
1. El archivo de.php es el encargado de generar el archivo xml firmado que luego lo guarda dentro de la carpeta de/ con el nombre del número de Id enviado
2. El archivo sedn_xml.php lo que hace es enviar el archivo generado previamente y ya firmado a los servidores de la SIFEN
3. El archivo aravo.php en este momento lo que hace es traer la hora de los servidores proporcionados por la SIFEN ya que la hora no debe estar adelantado al momento de hacer el envío del xml según la referencia de estos servidores
4 .El archivo test.php muestra el funcionamiento del archivo de.php enviando un JSON al mismo y generando así un archivo firmado.

5. En caso de querer implementar se debe enviar un archivo JSON a de.php para que genere el archivo xml pedido por la SIFEN.
6. Los detalles y ejemplo del JSON y las necesidades de las mismas puedes encontrarlas tanto en el archivo test.php como en el manual de la SIFEN
