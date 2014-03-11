<?php
// Cookie setzen wenn noch nicht teilgenommen
if(isset($_COOKIE['status'])){
$teilgenommen = true;
}
else {
setcookie('status','anonym',time() + (400 * 1)); // 86400 = 1 tag
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Danke für die Teilnahme!</title>
<link rel="stylesheet" href="style.css" />
</head>

<body>
<div id="content">
<h1>Danke für die Einsendung!</h1>
<p>Hier steht dann, was man als Nächstes tun soll oder welche weiteren interessanten Angebote es noch so gibt.</p>
</div><!-- Ende content -->

</body></html>