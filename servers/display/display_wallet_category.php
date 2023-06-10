<?php 
	// ADD USER


	// LOAD USERS
	$user_query = "SELECT * FROM users";
	$user_query_result = mysqli_query($connection, $user_query);
	$users_list = mysqli_fetch_all($user_query_result, MYSQLI_ASSOC);
?>


<table class="object-list">
    <caption>Linking Wallets and Categories</caption>
	<thead>
		<tr style="border: 3px solid rgb(11, 79, 73);">
			<th>userID</th>
			<th>Name</th>
			<th>Pass</th>
			<th>Actions</th>
		</tr>
	</thead>
	
	<tbody>
		<?php if (empty($users_list)): ?>
			<p>There is no user here</p>
		<?php endif; ?>


		<?php foreach ($users_list as $user): ?>
			<tr>
				<td><?php echo $user["userID"]; ?></td>
				<td><?php echo $user["name"]; ?></td>
				<td><?php echo $user["password"]; ?></td>
				<td>
					<button class="action-btn edit">Edit</button>
					<button class="action-btn delete">Delete</button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>