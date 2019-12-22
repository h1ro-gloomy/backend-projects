<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_car";

$id = $_GET['id'];


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
    $sql = "DELETE from categories WHERE parent_id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sql2 = "DELETE from categories WHERE id = '$id'";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();

	
	





}
		
		
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>