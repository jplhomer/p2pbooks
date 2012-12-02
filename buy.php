<?php include("./elements/header.php");

if (isset($_POST['price'])) {

	$price = $_POST['price'];

	// Include the Dwolla REST Client
	require './lib/dwolla.php';

	// Include any required keys
	require '_keys.php';

	// Instantiate a new Dwolla REST Client
	$Dwolla = new DwollaRestClient();

	// Seed a previously generated access token
	$Dwolla->setToken($token);

	$transactionId = $Dwolla->send($pin, '812-713-9234', $price);
	if(!$transactionId) { $msg = "Error: {$Dwolla->getError()} \n"; } // Check for errors
	else { $msg = "Transaction sent: {$transactionId} \n"; } // Print Transaction ID
}
?>

	<?php $bookId = $_GET['bookId']; ?>

	<?php if (!empty($msg)) { ?>

	<h2><?php echo $msg; ?></h2>

	<?php } else { ?>

	<h2>Buy Book</h2>

	<?php $book = lookupBook($bookId, false); ?>

	<form class="form" method="post" action="./buy.php">

		<div class="cover">
			<img src="<?php echo $book->image; ?>" />
		</div>
		<div class="info">
			<h3><?php echo $book->title; ?></h3>

			<h4><?php echo $book->author; ?></h4>

			<p>You're about to buy this book for <strong>$<?php echo $book->listPrice; ?></strong>. Proceed?</p>

			<input type="hidden" name="price" value="<?php echo $book->listPrice; ?>" />

			<input type="submit" class="btn" value="Send money to this dude" />
		</div>
	</form>

	<?php } ?>

<?php include("./elements/footer.php"); ?>