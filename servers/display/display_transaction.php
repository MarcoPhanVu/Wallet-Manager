<?php 
	// ADD USER


	// LOAD USERS
	$transaction_query = "SELECT * FROM transactions";
	$transaction_query_result = mysqli_query($connection, $transaction_query);
	$transactions_list = mysqli_fetch_all($transaction_query_result, MYSQLI_ASSOC);
?>

<table class="object-list large">
	<caption>Transactions List</caption>
	<thead>
		<tr>
			<?php foreach (array_keys($transactions_list[0]) as $key): ?> // Use array_keys() for associative arrays
				<td><?php echo $key; ?></td>
			<?php endforeach; ?>
			<th>Actions</th>
		</tr>
	</thead>
	
	<tbody>
		<?php if (empty($transactions_list)): ?>
			<p>There is no transaction for now</p>
			<? else: ?>
				echo "let's just keep it this way for now";

		<?php endif; ?>

		<?php 
			echo "checker";
		?>

		<?php foreach ($transactions_list as $transaction): ?>
			<tr>
				<?php foreach (array_keys($transaction) as $key): ?>
					<td><?php echo $transaction[$key]; ?></td>
				<?php endforeach; ?>
				<td>
					<button class="action-btn edit">Edit</button>
					<button class="action-btn delete">Delete</button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>