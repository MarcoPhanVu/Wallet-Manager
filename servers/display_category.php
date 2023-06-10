<!-- <?php include "../components/header_server.php" ?> -->

<?php 
	// ADD USER


	// LOAD USERS
	$category_query = "SELECT * FROM categories";
	$category_query_result = mysqli_query($connection, $category_query);
	$categories_list = mysqli_fetch_all($category_query_result, MYSQLI_ASSOC);
?>


<table class="object-list large">
	<caption>Categories List</caption>
	<thead>
		<tr style="border: 3px solid rgb(11, 79, 73);">
            <th>categoryID</th>
			<th>categoryName</th>
			<th>Description</th>
			<th>budget</th>
			<th>link to userID</th>
			<th>Actions</th>
		</tr>
	</thead>
	
	<tbody>
		<?php if (empty($categories_list)): ?>
			<p>There is no user here</p>
		<?php endif; ?>


		<?php foreach ($categories_list as $category): ?>
			<tr>
				<td><?php echo $category["categoryID"]; ?></td>
				<td><?php echo $category["name"]; ?></td>
				<td><?php echo $category["description"]; ?></td>
				<td><?php echo $category["budget"]; ?></td>
				<td><?php echo $category["userID"]; ?></td>
				<td>
					<button class="action-btn edit">Edit</button>
					<button class="action-btn delete">Delete</button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>