<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
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

<div id='container'>

	<?php
	if($schedule['type'] == 'tournamentSingleElimination'){
		echo'<h3>List of matches</h3><div id="schedule"><table class="table"><thead class="thead-light"><tr><th scope="col">#</th><th scope="col">Team 1</th><th scope="col"></th><th scope="col">Team 2</th></tr></thead><tbody>';
		foreach($schedule['matches'] as $match){
			echo '<tr class="result"><td>' . $match->get_matchId(). '</td><td>' . $match->get_team1() . '</td><td>vs</td><td>' . $match->get_team2(). '</td></tr>';
			
		}
		echo '</tbody></table></div>';
	} else if($schedule['type'] == 'leagueRoundRobin'){
		echo'<div class="row">';
		foreach($schedule['groups'] as $group){

			echo'<div class="col-md-6"><h4>Group '.$group->get_groupId().'</h4>';
			echo '<table class="table table-striped"><thead class="thead-light"><tr><th scope="col">#</th><th scope="col">Team</th></tr></thead><tbody>';
			$i = 1;
			$teams = $group->get_teams();
			foreach($teams as $key=>$team){
				echo '<tr class="result"><td>' . $i . '</td><td>' . $team . '</td></tr>';
				$i += 1;
			}
			echo '</tbody></table></div>';
		}
		echo'</div>';
		echo'<div class="row">';
		foreach($schedule['groups'] as $group){
			echo '<div class="col-md-6"><h4>Matches for group '.$group->get_groupId().'</h4>';
			echo '<table class="table table-striped"><thead class="thead-light"><tr><th scope="col">#</th><th scope="col">Team 1</th><th scope="col"></th><th scope="col">Team 2</th></tr></thead><tbody>';
			$i = 1;
			foreach($schedule['group'.$group->get_groupId().'Matches'] as $match){
				echo '<tr class="result"><td>' . $i . '</td><td>' . $match->get_team1() . '</td><td>vs</td><td>' . $match->get_team2() . '</td></tr>';
				$i += 1;
			}
			echo '</tbody></table></div>';
		}
		echo '</div>';
	} else {
		echo'<h3>List of matches</h3><table class="table table-striped"><thead class="thead-light"><tr><th scope="col">#</th><th scope="col">Team 1</th><th scope="col"></th><th scope="col">Team 2</th></tr></thead><tbody>';
		foreach($schedule['matches'] as $match){
			echo '<tr class="result"><td>' . $match->get_matchId(). '</td><td>' . $match->get_team1() . '</td><td>vs</td><td>' . $match->get_team2(). '</td></tr>';
			
		}
		echo '</tbody></table><div class="row"><div class="col-md-6"><h4>Winners matches</h4><table class="table table-striped"><thead class="thead-light"><tr><th scope="col">#</th><th scope="col">Team 1</th><th scope="col"></th><th scope="col">Team 2</th></tr></thead><tbody>';
	
		foreach($schedule['winnerMatches'] as $match){
			echo '<tr class="result"><td>' . $match->get_matchId(). '</td><td>' . $match->get_team1() . '</td><td>vs</td><td>' . $match->get_team2(). '</td></tr>';
		}

		echo '</tbody></table></div><div class="col-md-6"><h4>Losers matches</h4><table class="table table-striped"><thead class="thead-light"><tr><th scope="col">#</th><th scope="col">Team 1</th><th scope="col"></th><th scope="col">Team 2</th></tr></thead><tbody>';
		foreach($schedule['loserMatches'] as $match){
			echo '<tr class="result"><td>' . $match->get_matchId(). '</td><td>' . $match->get_team1() . '</td><td>vs</td><td>' . $match->get_team2(). '</td></tr>';
		}
		echo '</tbody></table></div></div>';
	}
	?>

</div>

</html>