<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Image Captcha Example</h1>
	<h5>http://thepiggery.net/captcha/fonts/</h5>

	<hr>
	<form action="text-code.php" method="post">

		<p>Enter the Email:
			<input type="text" name="email"/>
		</p>
		
		<p>Enter the Captcha:
			<img src="captcha.jpeg" id="img-captcha"> 
			<a href="#" id="refresh-anchor">refresh</a>
			<br/>
			<input type="text" name="captcha"/> 
			
		</p>

		<p>
			<input type="submit" name="submit" />
		</p>
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#refresh-anchor").on("click",function(event){
				
				//disable Caching in the Version

				var ver=Math.floor(Math.random() * 100); 
				event.preventDefault();
				
				$.ajax({

					url:"captcha-2.php?v="+ver,
					type:"GET",
					success:function(image){
						$("#img-captcha").attr("src","captcha.jpeg?v="+ver);
					}
				});
				
			});
			
		});
	</script>
</body>
</html>

