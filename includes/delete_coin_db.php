<?Php 
	
	include('db.php');

	// print_r($_POST);

	$coinId = $_POST['coin_id'];
	
	$deleteCoin = "DELETE FROM cryptofolio WHERE id=" . $coinId;

	if( mysqli_query($con, $deleteCoin) )
	{
		echo "succes";
	}
	else
	{
		echo "Oops, can not Delete coin:" . $deleteCoin . "<br />" . mysqli_error($con);
	}

?>