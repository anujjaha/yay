<center><h1>COMPANY LIST</h1></center>


<table border="1">
	<tr>
		<td align="center">Sr</td>
		<td align="center">Name</td>
		<td align="center">City:</td>
		<td align="center">Email:</td>
		<td align="center">Category</td>


	</tr>

	<?php
		$sr = 1;
		foreach ($results as $result)
		{
		?>
			<tr>
				<td align="center"><?php echo $sr;?></td>
				<td align="center"><?php echo $result['name'];?></td>
				<td align="center"><?php echo $result['city']; ?> </td>
				<td align="center"><?php echo $result['email'];?></td>
				<td align="center"><?php echo $result['category']; ?> </td>
			</tr>
		<?php
			$sr = $sr + 1;
		}
	?>
</table>