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
	  <script defer src="javascript/jquery.session.js"></script>
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <!-- Navbar content -->
  <a class="navbar-brand" href="#">
    <img src="logo.png" width="60" height="40" alt="">
	Tournament Organisation
  </a>
</nav>
<center>

<div class="container">
<h1>Create a schedule</h1>
<form action='<?php echo base_url("create_schedule")?>' autocomplete="off" method='post'>
<label for='discipline'>Choose discipline</label>
<select name='discipline' class="custom-select">
<option value='league of legends'>League of Legends</option>
	<option value='valorant'>Valorant</option>
	<option value='destiny 2'>Destiny 2</option>

</select>
<label for='numberOfTeams'>Choose number of teams</label>
<select id='numberOfTeams' name='numberOfTeams' class="custom-select">
<!-- Create 50 options -->
<?php
    for ($i=2; $i<50; $i+=2)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
</select>
<label for='typeOfSchedule'>Choose type of schedule</label>
<select id='typeOfSchedule' name='typeOfSchedule' class="custom-select">
	<option value='tournamentSingleElimination'>Tournament Single Elimination</option>
	<option value='leagueRoundRobin'>League Round Robin</option>
	<option value='tournamentDoubleElimination'>Tournament Double Elimination</option>
</select>
<label for='teamsNames'>Do you want enter teams names?</label>
<input type="checkbox" id='teamsNames' data-toggle="collapse" data-target="#insertteamname">
<div id="insertteamname" class="collapse">	 
</div><br>
<button type="submit" class="btn btn-outline-info"><h1>Submit</h1></button>
</form>
</div>


</center>
</body>
<script>

$(document).ready(function()
{	
	var numberOfTeams = $("#numberOfTeams").val();
	//checks if teamsNames checkbox changes
	$("#teamsNames").change(function()
	{   //set chosen number of teams
		numberOfTeams = $("#numberOfTeams").val();
		//if chechbox changed, check if it is ticked
		if($("#teamsNames").is(':checked')){
			//create as many team's inputs as was chosen
			for(var i = 1; i <= numberOfTeams; i++){
				//insert into insertteamname's div label and input
				$("#insertteamname").append("<div class='form-group'><label for='team" + i + "'>Team" + i+ 
				"</label><input type='text' name='team"+ i + "'id='team" + i + "' class='form-control' minlength='4' maxlength='25'>");

				//change team name value if it exists in session
				if(typeof($.session.get("team" + i)) != "undefined" && $.session.get("team" + i) != null){
					$("#team" + i).val($.session.get("team" + i));
				}
			}
		} else {
			//set each team name in session
			for(var j = 1; j <= numberOfTeams; j++){
				$.session.set("team" + j, $("#team" + j).val());
			}
			//if checkbox is unticked, then delete all children of insertteamname's div
			$("#insertteamname").empty();
		}
	});
	//checks if numberOfTeams drop down list changes
	$("#numberOfTeams").change(function(){
		//if chechbox changed, check if it is ticked
		if($("#teamsNames").is(':checked')){
			for(var j = 1; j <= numberOfTeams; j++){
				$.session.set("team" + j, $("#team" + j).val());
			}
			//if checkbox is already ticked delete all children of insertteamname's div
			$("#insertteamname").empty();
			//set chosen number of teams
			numberOfTeams = $("#numberOfTeams").val();
			//create as many team's inputs as was chosen
			for(var i = 1; i <= numberOfTeams; i++){
				//insert into insertteamname's div label and input
				$("#insertteamname").append("<div class='form-group'><label for='team" + i + "'>Team" + i+ 
				"</label><input type='text' name='team" + i + "' id='team" + i + "' class='form-control' minlength='4' maxlength='25'>");

				//change team name value if it exists in session
				if(typeof($.session.get("team" + i)) != "undefined" && $.session.get("team" + i) != null){
					$("#team" + i).val($.session.get("team" + i));
				}
			}
		} else {
			//if checkbox is unticked, then delete all children of insertteamname's div
			$("#insertteamname").empty();
		}
	});
});
</script>
</html>
