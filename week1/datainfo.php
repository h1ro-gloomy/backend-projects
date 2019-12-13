<?php
//echo "<table style='border: solid 1px black;'>";
//echo "<tr><th>Id</th><th>Title</th><th>Parent_id</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_car";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id, title, parent_id FROM categories"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    //foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
    //    echo $v;
		
   // }
	$cars = $stmt->fetchAll();
	$res['cars'] = array();
	foreach($cars as $car){
		$arr = array();
		$arr['id'] = $car['id'];
		$arr['title'] = $car['title'];
		$arr['parent_id'] = $car['parent_id'];
		array_push($res['cars'],$arr);
	}
	echo json_encode($res);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>