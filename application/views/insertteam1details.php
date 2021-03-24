<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script defer src="<?php echo base_url();?>javascript/customscript.js"></script>
</head>
<body>
	<center>

<img src="<?php echo base_url();?>projectimages/logo12.jpg" alt "" style "width: 600px;">

<div class="container">
  <button type="button" class="btn btn-outline-success btn-block" data-toggle="collapse" data-target="#teamsinfobutton">Insert Team Info</button>
  <div id="teamsinfobutton" class="collapse">

<div class="container p-3 my-3 border">


			  <h3>
					<label for="numberofteammembers">How Many Members Are On Your Team?</label>
					<select name="numberofteammembers" class="custom-select-sm" onchange="changemembersvisibility()" id="numberofteammembers" required>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
						</select>
	<br>

</h3>

<button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#insertteam1details">
Insert Team Member Details
</button>

<!-- The Modal -->
<div class="modal" id="insertteam1details">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Member Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

				<div class="form-group">
					<label id="teammember1firstnamelabel" for="teammember1firstname">Team Member 1 First Name</label>
					<input type="text" class="form-control" id="teammember1firstname" placeholder="Please Insert Your Teamember 1 First Name" name="teammember1firstname">
				</div>
				<br>

				<div class="form-group">
					<label id="teammember1surnamelabel" for="teammember1surname">Team Member 1 Surname Name</label>
					<input type="text" class="form-control" id="teammember1surname" placeholder="Please Insert Your Teamember 1 Surname Name" name="teammember1surname">
				</div>

				<br>
				<br>
				<div class="form-group">
					<label id="teammember2firstnamelabel" for="teammember2firstname">Team Member 2 First Name</label>
					<input type="text" class="form-control" id="teammember2firstname" placeholder="Please Insert Your Teamember 2 First Name" name="teammember2firstname">
				</div>
				<br>

				<div class="form-group">
					<label id="teammember2surnamelabel" for="teammember2surname">Team Member 2 Surname Name</label>
					<input type="text" class="form-control" id="teammember2surname" placeholder="Please Insert Your Teamember 2 Surname Name" name="teammember2surname">
				</div>

				<br>
				<br>

				<div class="form-group">
					<label id="teammember3firstnamelabel" for="teammember3firstname">Team Member 3 First Name</label>
					<input type="text" class="form-control" id="teammember3firstname" placeholder="Please Insert Your Teamember 3 First Name" name="teammember3firstname">
				</div>
				<br>

				<div class="form-group">
					<label id="teammember3surnamelabel" for="teammember3surname">Team Member 3 Surname Name</label>
					<input type="text" class="form-control" id="teammember3surname" placeholder="Please Insert Your Teamember 3 Surname Name" name="teammember3surname">
				</div>

				<br>
				<br>
				<div class="form-group">
					<label id="teammember4firstnamelabel" for="teammember4firstname">Team Member 4 First Name</label>
					<input type="text" class="form-control" id="teammember4firstname" placeholder="Please Insert Your Teamember 4 First Name" name="teammember4firstname">
				</div>
				<br>

				<div class="form-group">
					<label id="teammember4surnamelabel" for="teammember4surname">Team Member 4 Surname Name</label>
					<input type="text" class="form-control" id="teammember4surname" placeholder="Please Insert Your Teamember 4 Surname Name" name="teammember4surname">
				</div>


				<br>
				<br>
				<div class="form-group">
					<label id="teammember5firstnamelabel" for="teammember5firstname">Team Member 5 First Name</label>
					<input type="text" class="form-control" id="teammember5firstname" placeholder="Please Insert Your Teamember 5 First Name" name="teammember5firstname">
				</div>
				<br>

				<div class="form-group">
					<label id="teammember5surnamelabel" for="teammember5surname">Team Member 5 Surname Name</label>
					<input type="text" class="form-control" id="teammember5surname" placeholder="Please Insert Your Teamember 5 Surname Name" name="teammember5surname">
				</div>


				<br>
				<br>

				<div class="form-group">
					<label id="teammember6firstnamelabel" for="teammember6firstname">Team Member 6 First Name</label>
					<input type="text" class="form-control" id="teammember6firstname" placeholder="Please Insert Your Teamember 6 First Name" name="teammember6firstname">
				</div>
				<br>

				<div class="form-group">
					<label id="teammember6surnamelabel" for="teammember6surname">Team Member 6 Surname Name</label>
					<input type="text" class="form-control" id="teammember6surname" placeholder="Please Insert Your Teamember 6 Surname Name" name="teammember6surname">
				</div>


				<br>
				<br>

				<div class="form-group">
					<label id="teammember7firstnamelabel" for="teammember7firstname">Team Member 7 First Name</label>
					<input type="text" class="form-control" id="teammember7firstname" placeholder="Please Insert Your Teamember 7 First Name" name="teammember7firstname">
				</div>
				<br>

				<div class="form-group">
					<label id="teammember7surnamelabel" for="teammember7surname">Team Member 7 Surname Name</label>
					<input type="text" class="form-control" id="teammember7surname" placeholder="Please Insert Your Teamember 7 Surname Name" name="teammember7surname">
				</div>

				<br>
				<br>

				<div class="form-group">
					<label id="teammember8firstnamelabel" for="teammember8firstname">Team Member 8 First Name</label>
					<input type="text" class="form-control" id="teammember8firstname" placeholder="Please Insert Your Teamember 8 First Name" name="teammember8firstname">
				</div>
				<br>

				<div class="form-group">
					<label id="teammember8surnamelabel" for="teammember8surname">Team Member 7 Surname Name</label>
					<input type="text" class="form-control" id="teammember8surname" placeholder="Please Insert Your Teamember 8 Surname Name" name="teammember8surname">
				</div>
				</h3>
					<button type="submit" class="btn btn-outline-success btn-block"><h1>Submit</h1></button>
					</form>
				</div>
      </div>
    </div>
  </div>

	<button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#insertteam2details">
	Insert Team Member Details
	</button>




</div>


</div>
</div>


</center>
</body>
</html>
