<?php
$conn = mysqli_connect("sql303.epizy.com","epiz_30487033","JSXhoqxmP7K8g","epiz_30487033_consulta");
//$conn = mysqli_connect("localhost","root","","consulta");
// Check connection
if(mysqli_connect_errno()){
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>