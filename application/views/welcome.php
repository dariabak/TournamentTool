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
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <!-- Navbar content -->
  <a class="navbar-brand" href="#">
    <img src="logo.png" width="60" height="50" alt="">
	Tournament Organisation
  </a>
</nav>
<center>

<div class="container">
<h1>Create a schedule</h1>
<form action="" autocomplete="off">
<label for='discipline'>Choose discipline</label>
<select name='discipline' class="custom-select">
	<option value='league of legends'>League of Legends</option>
	<option value='valorant'>Valorant</option>
	<option value='destiny 2'>Destiny 2</option>
</select>
<label for='numberOfTeams'>Choose number of teams</label>
<select id='numberOfTeams' class="custom-select">
<!-- Create 50 options -->
<?php
    for ($i=1; $i<=50; $i++)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select>
<label for='typeOfSchedule'>Choose type of schedule</label>
<select id='typeOfSchedule' class="custom-select">
	<option value='leagueRoundRobin'>League Round Robin</option>
	<option value='tournamentSingleElimination'>Tournament Single Elimination</option>
	<option value='tournamentDoubleElimination'>Tournament Double Elimination</option>
</select>
<label for='teamsNames'>Do you want enter teams names?</label>
<input type="checkbox" id='teamsNames' data-toggle="collapse" data-target="#insertteamname">
<div id="insertteamname" class="collapse">	 
</div>
</div>
<button type="submit" class="btn btn-outline-info"><h1>Submit</h1></button>
  </form>
</div>


</center>
</body>
<script>
$(document).ready(function()
{
	$("#teamsNames").change(function()
	{
		if($("#teamsNames").is(':checked')){
			var numberOfTeams = $("#numberOfTeams").val();
			for(var i = 1; i <= numberOfTeams; i++){
				$("#insertteamname").append("<div class='form-group'><label for='Team" + i + "'><h2>Team" + i+ "</h2></label><input type='text' name='team" + i + "' class='form-control' required minlength='4' maxlength='25'>");
			}
			
		} else {
			$("#insertteamname").empty();
		}
	});
});
</script>
</html>
