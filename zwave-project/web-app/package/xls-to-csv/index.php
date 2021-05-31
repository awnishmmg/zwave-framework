<!DOCTYPE html>
<html>
<head>
	<title>::Upload Zip ::</title>
</head>
<body>
	<h1>Upload Files</h1>
	<hr/>

<form method="post" enctype="multipart/form-data" action="upload.php">
	<p>
		Select the File : 
		<input type="file" name="files" accept=".zip" />
	</p>

	<p>
		<input type="submit" name="submit"/>
	</p>
</form>

	
</body>
</html>