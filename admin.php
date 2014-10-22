<?php
	
		/*Username	:<input type='text' name='username'><br>
		Password	:<input type='password' name='password'><br>*/
?>
<html>
	<form action='login.php' method='POST'>
		<table>
		<tr>
			<td>
				Username :
			</td>
			<td>
				<input type='text' name='username' value='<?php echo $username;?>'>
			</td>
		</tr>
		<tr>
			<td>
				Password :
			</td>
			<td>
				<input type='password' name='password'>
			</td>
		</tr>
	
		</table>
		<input type='submit' value='log in'><br>
	</form>
</html> 


	