<!DOCTYPE html>
<html>
	<head>
		
	</head>
	<body>
		<h1>Welcome, <?php echo $uname; ?></h1>
		<br/>
		<?php echo form_open_multipart('itemgen/generate');?>
			<input type='file' name='pdf_file[]' multiple='true'><br/>
			<input type='submit' value='upload'>
		<?php echo form_close();?>
		<?php
			/*echo "<h1> Chapter_01.pdf</h1>";
			foreach ($page1 as $page) {
				echo $page;
			}

			echo "<h1>Chapter_02.pdf</h1>";
			foreach ($page2 as $page) {
				echo $page;
			}*/
		?>
	</body>	
</html>