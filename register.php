<?php include("./elements/header.php"); ?>

	<h2>Register</h2>

	<form class="register form" method="post">
		<label for="firstName">First Name</label>
		<input type="text" name="firstName" id="firstName" placeholder="First Name" />

		<label for="lastName">Last Name</label>
		<input type="text" name="lastName" id="lastName" placeholder="Last Name" />

		<label for="username">Username</label>
		<input type="text" name="username" id="username" placeholder="Username" />

		<label for="password">Password</label>
		<input type="password" name="password" id="password" />

		<label for="password-check">Password (repeat)</label>
		<input type="password" name="password-check" id="password-check" />

		<label for="campus">College Campus</label>
		<select name="campus">
			<?php $campuses = listAllCampuses();
			foreach ($campuses as $campus) { ?>
				<option value="<?php echo $campus->id; ?>"><?php echo $campus->name; ?></option>
			<?php } ?>
		</select>

		<input type="submit" class="btn" value="Register" />
		<input type="hidden" name="action" value="createUser" />
	</form>

<?php include("./elements/footer.php"); ?>