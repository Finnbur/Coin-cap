<?Php 
	session_start();
	header('Content-Type: application/json');

	include('db.php');

	$getAllCoins = "SELECT * FROM cryptofolio WHERE userId =" . $_SESSION['userId'];

	$resultGetAllCoins = mysqli_query($con, $getAllCoins);

	$allCoinsArray = array(); 

	while ($rowAllCoins = mysqli_fetch_assoc($resultGetAllCoins)) {

		$allCoinsArray[] = $rowAllCoins;
	}
	
	echo json_encode($allCoinsArray);

?>