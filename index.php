<?php include("./elements/header.php"); ?>

    <div class="cover-layout">
        <?php $books = listAll();
        foreach ($books as $book) { ?>
        <a class="book">
            <div class="cover">
                <img src="http://placehold.it/200x250" />
            </div>
            <div class="info">
                <div class="price">$<?php echo $book->listPrice; ?></div>
                <h3 class="title"><?php echo $book->title; ?></h3>
                <div class="author"><?php echo $book->author; ?></div>
            </div>
        </a>
        <?php } ?>

        <?php //for ($x = 0; $x < 12; $x++) { ?>
        <!--<a class="book">
            <div class="cover">
                <img src="http://placehold.it/200x250" />
            </div>
            <div class="info">
                <div class="price">$20</div>
                <h3 class="title">Book Title</h3>
                <div class="author">Book Author</div>
            </div>
        </a>-->
        <?php // } ?>
        
    </div>

<?php include("./elements/footer.php"); ?>