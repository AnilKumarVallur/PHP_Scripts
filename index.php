<?php
	include('connection.php');
	$message = ' ';
	if(isset($_POST['submit'])){
		$sub = $_POST['subject'];
		$link = $_POST['link'];
		$query = mysqli_prepare($conn, "INSERT into links(Subject, Link) values(?,?)");
		mysqli_stmt_bind_param($query, "ss", $sub, $link);
		if(mysqli_stmt_execute($query)){
			$message = 'Successfully inserted';
		} else{
			$message = 'Insertion failed';
		}
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src='js/jquery.min.js'></script>
	<script src='js/bootstrap.min.js'></script>
	<link rel='stylesheet' href='css/bootstrap.min.css'>
	<style>
	table{
		width:100%;
	}
	input{
		width:100%;
		margin-bottom: 5px;
	}
	#message {
		-moz-animation: cssAnimation 0s ease-in 5s forwards;
		/* Firefox */
		-webkit-animation: cssAnimation 0s ease-in 5s forwards;
		/* Safari and Chrome */
		-o-animation: cssAnimation 0s ease-in 5s forwards;
		/* Opera */
		animation: cssAnimation 0s ease-in 5s forwards;
		-webkit-animation-fill-mode: forwards;
		animation-fill-mode: forwards;
	}
	@keyframes cssAnimation {
		to {
			width:0;
			height:0;
			overflow:hidden;
		}
	}
	@-webkit-keyframes cssAnimation {
		to {
			width:0;
			height:0;
			visibility:hidden;
		}
	}
	.band{
		height:10px;
		background-color:#000000;
	}
	.footer{
		margin-top:10px;
		background-color:#000000;
	}
	.footer p{
		padding: 5px;
		color:#ffffff;
	}
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		margin-bottom:10px;
		overflow: hidden;
		background-color: #333;
	}

	li {
		float: left;
	}

	li a {
		display: block;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}

	li a:hover {
		background-color: #111;
	}
	</style>
	<title>Good Read</title>
</head>
<body>
  <ul>
	<li><a href="index.php">Add Read</a></li>
	<li><a href="read.php">Read Pages</a></li>
  </ul>
  <div class='container'>
	<h1 style='text-align:center'>Good Reads</h1>
	<div class='row'>
		<div class='col-md-4'>
		</div>
		<div class='col-md-4'>
			<table>
				<form action=' ' method='post'>	
					<tbody>
						<?php echo "<p id='message' style='text-align:center'>$message</p>"; ?>
						<tr><td>SUBJECT:</td><td><input type='text' name='subject' required/></td></tr>
						<tr><td>LINK:</td><td><input type='text' name='link' required/></td></tr>
						<tr><td></td><td><input type='submit' name='submit' value='submit'/></td></tr>
					</tbody>
				</form>
			</table>
		</div>
		<div class='col-md-4'>
		</div>
	</div>
  </div>
  <div class='footer'>
	<p style='text-align:center'>No &copy;, enjoy adding, reading!</p>
  </div>

</body>
</html>