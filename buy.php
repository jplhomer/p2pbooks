<?php include("./elements/header.php"); ?>

	<?php $bookId = $_GET['bookId']; ?>

	<h2>Buy Book</h2>

	<?php $book = lookupBook($bookId, false); ?>

	<h3><?php echo $book->title; ?></h3>

	<h4><?php echo $book->author; ?></h4>

	<img src="<?php echo $book->thumbnail; ?>" />

	<a class="btn" href="#">Send Money</a>

<?php include("./elements/footer.php"); ?>