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

    $sql = "select * from categories where id = '$id'";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();
	$info = $stmt->fetch(PDO::FETCH_OBJ);
		/*echo $info->id;
		echo"<br>";
		echo $info->title;
		echo"<br>";
		echo $info->parent_id; */
	echo json_encode(array('id'=>$info->id, 'title'=>$info->title,'parent_id'=>$info->parent_id));
		

}
		
		
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>