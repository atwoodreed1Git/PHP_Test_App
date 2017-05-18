<?php 

$db_url = getenv('RECIPE_DB_URL');

$dbOpts = parse_url($db_url);

$dbHost = $dbOpts["host"];
$dbPort = $dbOpts["port"];
$dbName = ltrim($dbOpts["path"], '/');
$dbUser = $dbOpts["user"];
$dbPword = $dbOpts["pass"];

try
{
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPword);
}
catch (PDOException $ex)
{
	echo "Error: " . $ex->getMessage();
	die();
}

?>