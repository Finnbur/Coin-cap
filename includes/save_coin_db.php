<?Php 
	
	include('db.php');

	// print_r($_POST);

	$coinId = $_POST['coin_id'];
	$coinPrice = $_POST['coin_price'];
	$amountCoins = $_POST['amount_coins'];

	$coinPrice = str_replace('$', '', $coinPrice);
	$amountCoins = str_replace('$', '', $amountCoins);

	$totalValue = $coinPrice * $amountCoins;
	
	$updateCoin = "UPDATE cryptofolio SET amount='$amountCoins', totalValue='$totalValue' WHERE id=" . $coinId;

	if( mysqli_query($con, $updateCoin) )
	{
		echo "succes";
	}
	else
	{
		echo "Oops, can not update coin:" . $updateCoin . "<br />" . mysqli_error($con);
	}

?>