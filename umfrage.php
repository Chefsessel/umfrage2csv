<?php
// Cookie abrufen, ob schon teilgenommen
if(isset($_COOKIE['status'])){
$teilnahme = true;
}
else {
$teilnahme = false;
}
?>

<?php
// error handling wenn nicht vollständig ausgefüllt
if($_POST['formSubmit'] == "Abschicken")
{
	$frage1 = $_POST['formfrage1'];
	$frage2 = $_POST['formfrage2'];
		
	$errorMessage = "";
	
	if(empty($_POST['formfrage1']))
	{
		$errorMessage .= "<li class='errormsg'>Bitte füllen Sie das Textfeld aus!</li>";
	}
	if(empty($_POST['formfrage2']))
	{
		$errorMessage .= "<li class='errormsg'''>Bitte geben Sie Ihr Alter an!</li>";
	}
	
	// Funktion zum schreiben in .csv file
	if(empty($errorMessage)) 
	{
		$frage1 = str_replace("\r\n", " ", $frage1);
		$fs = fopen("ergebnis.csv","a");
		fwrite($fs,$frage1 . ";"  . $frage2 . "\n");
		fclose($fs);

		// Weiterleitung des Users auf Thank You page
		header("Location: danke.php");
		exit;
	}
}
?>

<!DOCTYPE html> 
<html>
<head>
	<title>Umfrage zum Intranet</title>
	<meta charset='utf-8'>
<link rel="stylesheet" href="style.css" />
</head>

<body>

	<?php
		if(!empty($errorMessage)) 
		{
			echo("<ul>" . $errorMessage . "</ul>\n");
		} 
	?>
	
	<div id="content">	
	<?php
	// wenn Teilnahme Cookie gesetzt, blende Fragen aus und zeige Hinweis an
	if($teilnahme == true){
	echo "<p style='text-align:center;'>Vielen Dank für die Teilnahme.<br> Jeder ist nur einmal teilnahmeberechtigt.";
	echo "<style>#show {display:none;}</style>";
	}
	?>

	<div id="show">
	<h1>Umfrage 2 CSV</h1>
	<p>Hier steht ein Beschreibungstext, worum es geht und warum man überhaupt teilnehmen soll. </p>
	
	<form action="umfrage.php" method="post" id="umfrage">

	<p><strong>Frage 1:</strong> Wie denken Sie über das Problem?</p>
		<p>
		<textarea class="textarea" id="frage1" rows="6" cols="45" name="formfrage1" value="<?=$frage1;?>"><?php echo $frage1 ?></textarea> 
		</p>
	
		
		<p><strong>Frage 2:</strong> Welche Lösung gefällt Ihnen am besten ?</p>
		<p>
		<input type="radio" name="formfrage2" value="0 - 16" /> Bla bla<br />
		<input type="radio" name="formfrage2" value="17 - 35" /> Blubb Blubb<br />
		<input type="radio" name="formfrage2" value="35 - 49" /> Hi hi hi hi hi<br />
		<input type="radio" name="formfrage2" value="50+" /> Nja nja nja nja<br />
		</p>
		
		<input type="submit" name="formSubmit" value="Abschicken" id="submit" onclick="return filter()"/>
	</form>
	</div><!-- Ende Show -->
	</div><!-- Ende Content -->

	
<script>
// erlaubte zeichen bei user input
var regex =  /^[a-zA-Z0-9öÖüÜäÄß?@()"'!,+-:.]+$/;

// durch input loopen und abgleichen mit regex
function filter() {
    var val = document.getElementById("frage1").value;
    var lines = val.split('\n');
    for(var i = 0; i < lines.length; i++) {
      if(!lines[i].match(regex)) {
        alert ('Unerlaubte Zeichen: ' + lines[i] + '  Bitte nehmen Sie diese heraus und versuchen Sie es noch einmal.');
        return false;
      } 
    }
	return true;
  }
</script>

</body>
</html>