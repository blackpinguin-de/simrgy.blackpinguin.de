<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="de">
<head>
	<title>Sim'rgy</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

<?php

if( $_POST["usability"]!=""
	&& $_POST["difficulty"]!=""
	&& $_POST["graphic"]!=""
	&& $_POST["music"]!=""
	&& $_POST["fun"]!=""
	&& $_POST["load"]!=""
	&& $_POST["lag"]!=""
	&& $_POST["rating"]!=""
)
	{
	include_once("mysql.php");

	$error = post("errors");
	$meinung = post("annotations");

	if($error=="" || strlen($error)>=1000) $error="NULL";
	else $error = "'$error'";

	if($meinung=="" || strlen($meinung)>=1000) $meinung="NULL";
	else $meinung = "'$meinung'";

	$usa = (int) post("usability");
	$dif = (int) post("difficulty");
	$gra = (int) post("graphic");
	$mus = (int) post("music");
	$fun = (int) post("fun");
	$loa = (int) post("load");
	$lag = (int) post("lag");
	$rat = (int) post("rating");

	$ip = $_SERVER["REMOTE_ADDR"];

	$sql  = " INSERT INTO `simrgy`.`feedback` ";
	$sql .= " (`version`,`date`,`time`,`ip`,`error`,`annotation`,`usability`, ";
	$sql .= " `difficulty`,`graphic`,`music`,`fun`,`load`,`lag`,`rating`) ";
	$sql .= " VALUES ('022', NOW(), NOW(), '$ip', $error , $meinung , ";
	$sql .= " '$usa', '$dif', '$gra', '$mus', '$fun', '$loa', '$lag', '$rat'); ";
	//echo $sql;
	$ret = @mysql_query($sql, $verbindung);
	if(!$ret) die("Fehler\n</body>\n</html>");

	echo "Danke f&uuml;r das Feedback\n<br>\n<br><a href=\".\">weiterspielen</a>";

	@mysql_close($verbindung);
	}
else
	{
	echo "Fehler";
	}
?>


</body>
</html>
