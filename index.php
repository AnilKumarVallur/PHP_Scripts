<?php
	include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src='js/vendor/jquery.js'></script>
	<script src='js/jquery.tablesorter.min.js'></script>
	<link rel='stylesheet' href='css/app.css'>
	<link rel='stylesheet' href='css/foundation.css'>
	<link rel='stylesheet' href='css/foundation.min.css'>
	<title>Employee Management</title>

	<style>
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
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
	#op{
		padding:2px;
		margin-right:5px;
	}
	#delete{
		padding:2px;
	}
	#insert{
		padding:2px;
		margin-right:5px;
	}
	#cancel{
		padding:2px;
	}
	#add-emp{
		text-align:center;
	}
	</style>
	<script>
	$(document).ready(function(){
		$('#keywords').tablesorter();
		$("a#op").click(function(){
			op = $(this).text();
			if(op == 'Edit'){
				($(this).parent()).siblings().attr('contenteditable','true');
				($(this).parent()).siblings().css('border','1px solid black');
				$(this).text('Save');
			}else{
				($(this).parent()).siblings().attr('contenteditable','false');
				($(this).parent()).siblings().css('border','none');
				$(this).text('Edit');
			}
			
			if(op == 'Save'){
				firstName = $(this).closest('tr').find('td:eq(0)').text();
				lastName = $(this).closest('tr').find('td:eq(1)').text();
				className = ($(this).parent()).parent().attr('class');
				var Eid = className.split('-');
				Eid = Eid[1];
				opid = 1;
				if(firstName && lastName){
				  $.ajax({
				    type: "POST",
				    url: "operation.php",
				    data: { 'firstName':firstName,'lastName': lastName,'EId':Eid,'opid':opid},	
				      success: function (data) {
				    }
				  });	
				} else {
					alert("Please don't leave the first or the last name empty");
					location.reload();
				}
				
			}
		});
		$("a#delete").click(function(){
			firstName = $(this).closest('tr').find('td:eq(0)').text();
			lastName = $(this).closest('tr').find('td:eq(1)').text();
			className = ($(this).parent()).parent().attr('class');
			var Eid = className.split('-');
			Eid = Eid[1];
			opid = 2;
			if (confirm("Are you sure you want to delete "+firstName+' '+lastName+'?') == true) {
				$.ajax({
				  type: "POST",
				  url: "operation.php",
				  data: {'EId':Eid,'opid':opid},	
				  success: function (data) {
				  }
				});
				$(this).closest('tr').remove();
			} else {
				
			}
			alert(x);
		});
		$("#add-emp").click(function() {
			$('#datatable tbody').append('<tr><td contenteditable="true" style="border:1px solid black"></td><td contenteditable="true" style="border:1px solid black"></td><td><a title="Insert Data" id="insert">Insert</a><a title="Cancel" id="cancel">Cancel</a></td></tr>');
			$("a#insert").click(function() {
				firstName = $(this).closest('tr').find('td:eq(0)').text();
				lastName = $(this).closest('tr').find('td:eq(1)').text();
				opid = 3;
				if(firstName && lastName){
					$.ajax({
					type: "POST",
					url: "operation.php",
					data: {'firstName':firstName,'lastName': lastName,'opid':opid},	
					success: function (data) {
					  location.reload();
					}
					});
				}
				else{
					alert("Please enter first and the last name");	
				}
				
			});
			$("a#cancel").click(function() {
				$(this).closest('tr').remove();
			});
		});
	});
	</script>
</head>
<body>
  <!-- <ul>
	<li><a href="index.php">Employee Data</a></li>
	<li><a href="add.php">Add Employee</a></li>
  </ul> -->
  <div id='datatable' class="table-responsive">
	<table id="keywords" class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
      <tr>
		<th><span>First Name</span></th>
		<th><span>Last Name</span></th>
		<th><span>Action</span></th>
	  </tr>
    </thead>
    <tbody>
      <?php
			$sql = mysqli_query($conn, "SELECT * FROM employee");
			if(mysqli_num_rows($sql) == 0){
				echo '<tr><td colspan="8">No data available.</td></tr>';
			}else{
				while($row = mysqli_fetch_assoc($sql)){
					echo '
					<tr class="emp-'.$row['EId'].'">
						<td contenteditable="false">'.$row['FirstName'].'</td>
						<td contenteditable="false">'.$row['LastName'].'</td>
						<td class="action">
							<a title="Edit Data" id="op">Edit</a>
							<a title="Delete Data" id="delete">Delete</a>
						</td>
					</tr>';
				}
			}
		?>
    </tbody>
	<tfoot>
		<tr>
			<td id='add-emp' colspan='3'> <a>Add employee</a> </td>
		</tr>
	</tfoot>
	</table>
  </div>
</body>
<script src='js/app.js'></script>
<script src='js/vendor/foundation.js'></script>
<script src='js/vendor/foundation.min.js'></script>
<script src='js/vendor/what-input.js'></script>
</html>
