<!DOCTYPE html>
<html>
	<head>
		
	</head>
	<body>
		<h3> <?php echo $error; ?></h3>
		<form id='login-student' action="http://localhost/trueorfalsetestitemgen/index.php/student/" method="post">
			<fieldset>
				<legend>Login as Student</legend>
				<input type='text' id='stud-uname' name='stud-uname' placeholder='Username' required='required'/><br/>
				<input type='password' id='stud-pw' name='stud-pw' placeholder='Password' required='required'/><br/>
				<input type='submit' id='stud-submit'>
			</fieldset>
		</form>
		<form id='login-teacher' action="http://localhost/trueorfalsetestitemgen/index.php/teacher/" method="post">
			<fieldset>
				<legend>Login as Teacher</legend>
				<input type='text' id='teacher-uname' name='teacher-uname' placeholder='Username' required='required' value=<?php 
					echo $uname;
				?>/><br/>
				<input type='password' id='teacher-pw' name='teacher-pw' placeholder='Password' required='required'/><br/>
				<input type='submit' id='teacher-submit'>
			</fieldset>
		</form>
	</body>	
</html>