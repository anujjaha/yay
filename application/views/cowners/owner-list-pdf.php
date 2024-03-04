<center><h1>Owner LIST</h1></center>


<table border="1">
	<tr>
		<td align="center">Sr</td>
		<td align="center">Company</td>
		<td align="center">Owner Name</td>
		<td align="center">Owner Email</td>
		<td align="center">Owner Mobile</td>
		<td align="center">Mobile 2</td>
		<td align="center">Gender</td>
		<td align="center">Date of Birth</td>
		<td align="center">Address1</td>
		<td align="center">Address2</td>
		<td align="center">City</td>
		<td align="center">State</td>
		<td align="center">Pin</td>
		


	</tr>

	<?php
		$sr = 1;
		foreach ($results as $result)
		{
		?>
			<tr>
				<td><?php echo $sr;?></td>
				<td><?php echo $result['name'];?></td>
				<td><?php echo $result['oname'];?></td>
				<td><?php echo $result['oemail'];?></td>
				<td><?php echo $result['omobile'];?></td>
				<td><?php echo $result['omobile2'];?></td>
				<td><?php echo $result['gender'];?></td>
				<td><?php echo $result['dob'];?></td>
				<td><?php echo $result['oadd1'];?></td>
				<td><?php echo $result['oadd2'];?></td>
				<td><?php echo $result['ocity'];?></td>
				<td><?php echo $result['ostate'];?></td>
				<td><?php echo $result['opin'];?></td>
			</tr>
		<?php
			$sr = $sr + 1;
		}
	?>
</table>