<?php include("./elements/header.php"); ?>

	<h2>Add a Book to Sell</h2>

	<form class="add-book">
		<div class="message"></div>

		<div class="image-holder">
			<input type="hidden" name="image" id="image" value="image" />
			<div class="image"><img src="http://placehold.it/128x197" alt="Image Placeholder" /></div>
			<label for="image">Image</label>
		</div>

		<div class="inputs">
			<label for="title">Title</label>
			<input name="title" id="add-book-title" type="text" placeholder="Title" />

			<label for="isbn">ISBN</label>
			<input name="isbn" id="isbn" type="text" placeholder="ISBN" />

			<label for="author">Author</label>
			<input name="author" id="author" type="text" placeholder="Author" />

			<label for="publisher">Publisher</label>
			<input name="publisher" id="publisher" type="text" placeholder="Publisher" />

			<label for="listPrice">Listing Price</label>
			<input name="listPrice" id="listPrice" type="text" placeholder="0.00" />

			<input name="userId" id="user" type="hidden" value="<?php echo $p2pbooksuser->singlyId; ?>" />

			<input type="submit" class="btn" value="Add Book" id="add-book" />
		</div>
	</form>

<?php include("./elements/footer.php"); ?>