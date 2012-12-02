<?php include("./elements/header.php"); ?>

<?php 
	if (!empty($_GET['query'])) {
    	$books = searchBooks($_GET['query']);
    } else {
    	$books = listAll();
    }
    $bookCount = count($books);
    ?>

    <h2>Search results for <em><?php echo $_GET['query']; ?></em>: (<?php echo $bookCount; ?>) results</h2>

    <div class="cover-layout">
        <?php 

        foreach ($books as $book) { ?>
        
        <a class="book" data-bookid="<?php echo $book->id; ?>">
            <div class="cover">
                <img src="http://placehold.it/128x197" />
            </div>
            <div class="info">
                <h3 class="title"><?php echo $book->title; ?></h3>
                <div class="author"><?php echo $book->author; ?></div>
                <div class="publisher"><?php echo $book->publisher; ?></div>
                <div class="price">$<?php echo $book->listPrice; ?></div>
            </div>
        </a>
        <?php } ?>

    </div>

<?php include("./elements/footer.php"); ?>