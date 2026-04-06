<?Php 
	session_start();
	include('db.php');

	// print_r($_POST); 

	$coinName = $_POST['coin_name'];
	$coinPrice = $_POST['coin_price'];
	$amountCoins = $_POST['amount_coins'];
	$totalValue = $_POST['total_value'];
	
	$userId = $_SESSION['userId'];
	
	$addCoin = "INSERT INTO cryptofolio (id, name, price, amount, totalValue, bought_on, userId) 
			VALUES (null, '$coinName', '$coinPrice', '$amountCoins', '$totalValue', NOW(), '$userId')";

	if( mysqli_query($con, $addCoin) )
	{
		echo "succes";
	}
	else
	{
		echo "Oops, can not add a coin to your cryptofolio:" . $addCoin . "<br />" . mysqli_error($con);
	}


?>