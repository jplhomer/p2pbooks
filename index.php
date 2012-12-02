<?php include("./elements/header.php"); ?>

    <div class="cover-layout">
        <?php $books = listAll();
        foreach ($books as $book) { ?>
        
        <a class="book" data-bookid="<?php echo $book->id; ?>">
            <div class="cover">
                <!--<img src="http://placehold.it/128x197" />-->
                <img src="<?php echo $book->image; ?>" alt="<?php echo $book->title; ?>" />
            </div>
            <div class="info">
                <h3 class="title"><?php echo $book->title; ?></h3>
                <div class="author"><?php echo $book->author; ?></div>
                <div class="publisher"><?php echo $book->publisher; ?></div>
                <?php $seller = findUser($book->userId); ?>
                <div class="seller">
                    <img class="thumbnail" src="https://graph.facebook.com/1182780067/picture?type=large&date_format=U" width="25" height="25" />
                    <div class="name">Josh Larson</div>
                </div>
                <?php setlocale(LC_MONETARY, 'en_US'); ?>
                <div class="price"><?php echo money_format('%.2n', $book->listPrice); ?></div>
                <?php if($book->sold) { ?>
                <div class="sold">SOLD</div>
                <?php } ?>
                
            </div>
        </a>

        <?php } ?>

    </div>

<?php include("./elements/footer.php"); ?>