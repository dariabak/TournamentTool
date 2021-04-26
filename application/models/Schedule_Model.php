<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_Model extends CI_Model{
    public function createSchedule($data){
        $matches = array();
        $matchesData = array();
        $teams = array();
        $matchesData['type'] = $data['typeOfSchedule'];
        
        for($i = 1; $i <= $data['numberOfTeams']; $i++){
            if(isset($data['team' . $i])){
                if($data['team' . $i] == ""){
                    $teams['team' . $i] = 'Team ' . $i;
                } else{
                    $teams['team' . $i] = $data['team' . $i];
                }
            } else{
                $teams['team' . $i] = 'Team ' . $i;
            }
        }

        switch($data['typeOfSchedule']){
            case 'leagueRoundRobin':
                $numberOfTeams = count($teams);
                $groups = array();
                if($numberOfTeams % 6 == 0){
                    $numberOfGroups = $numberOfTeams / 6;
                    for($i = 0; $i < $numberOfGroups; $i++){
                        $group = new Group();
                        $random_teams = array_rand($teams,6);
                        $group->set_teams($teams, $random_teams);
                        $group->set_groupId($i+1);
                        $y = count($random_teams);
                        for($j = 0; $j < $y; $j++){
                            unset($teams[$random_teams[$j]]);
                        }
                        array_push($groups, $group);
                       
                    }
                } else if($numberOfTeams % 5 == 0){
                    $numberOfGroups = $numberOfTeams / 5;
                    for($i = 0; $i < $numberOfGroups; $i++){
                        $group = new Group();
                        $random_teams = array_rand($teams,5);
                        $group->set_teams($teams, $random_teams);
                        $group->set_groupId($i+1);
                        $y = count($random_teams);
                        for($j = 0; $j < $y; $j++){
                            unset($teams[$random_teams[$j]]);
                        }
                        array_push($groups, $group);
                    }
                } else if($numberOfTeams % 4 == 0){
                    $numberOfGroups = $numberOfTeams / 4;
                    for($i = 0; $i < $numberOfGroups; $i++){
                        $group = new Group();
                        $random_teams = array_rand($teams,4);
                        $group->set_teams($teams, $random_teams);
                        $group->set_groupId($i+1);
                        $y = count($random_teams);
                        for($j = 0; $j < $y; $j++){
                            unset($teams[$random_teams[$j]]);
                        }
                        array_push($groups, $group);
                    }
                    
                }  else {
                    $numberOfGroups = ceil($numberOfTeams/6);
                    for($i = 0; $i < $numberOfGroups; $i++){
                        $group = new Group();
                        $x = floor($numberOfTeams/$numberOfGroups);
                        $random_teams = array_rand($teams,$x);
                        $group->set_teams($teams, $random_teams);
                        
                        $y = count($random_teams);
                        
                        for($j = 0; $j < $y; $j++){
                            unset($teams[$random_teams[$j]]);
                        }
                        array_push($groups, $group);
                    }

                    if(count($teams) != 0){
                        $random_group = array_rand($groups, 1);
                        $groups[$random_group]->set_additional_team(current($teams));
                    }

                }
              
                $matchesData['groups'] = $groups;
                $id = 1;

                foreach($groups as $group){
                    $teamsInGroup = $group->get_teams();
                    $group->set_groupId($id);
                    $teamsPairs = array();
                    foreach($teamsInGroup as $key=>$team){
                        for($i = 0; $i < count($teamsInGroup); $i++){
                            $x = $i + 1;
                            $str = $teamsInGroup['team'.$x] . $team;
                            $str2 = $team . $teamsInGroup['team'.$x];
                            if('team'.$x != $key && !in_array($str, $teamsPairs) && !in_array($str2, $teamsPairs)){
                                $match = new Match();
                                array_push($teamsPairs, $teamsInGroup['team'.$x] . $team);
                                $match->set_teams($teamsInGroup['team'.$x], $team);
                                array_push($matches, $match);  
                            }
                        }
                    }
                    shuffle($matches);
                    $matchesData['group'.$id.'Matches'] = $matches;
                    $matches = array();
                    $id+=1;
                }
           
                break;

            case 'tournamentSingleElimination':
                $id = 1;
                $numberOfTeams= count($teams);
                $x = floor(log(count($teams), 2));
                
                if(pow(2, $x) == $numberOfTeams){
                    $fullMatches = $numberOfTeams/2;
                } else {
                    $fullMatches = $numberOfTeams - pow(2, $x);
                }
                   
                for($i = 0; $i < $fullMatches; $i++){
                    $match = new Match();
                    $random_teams = array_rand($teams,2);
                    $match->set_teams($teams[$random_teams[0]], $teams[$random_teams[1]]);
                    array_push($matches, $match);
                    unset($teams[$random_teams[0]]);
                    unset($teams[$random_teams[1]]);
                }

                $emptyMatches = $numberOfTeams - 2 * $fullMatches;
              
                for($j = 0; $j < $emptyMatches; $j++){
                    $match = new Match();
                    $random_teams = array_rand($teams,1);
                    $team = "";
                    $match->set_teams($teams[$random_teams], $team);
                    array_push($matches, $match);
                    unset($teams[$random_teams]);
                }

                shuffle($matches);
                $id = 1;
                foreach($matches as $match){
                    $match->set_matchId($id);
                    $id += 1;
                }
      
               $t = 0;
                
                while($t != count($matches) - 1){
                    $matches2 = array();
                 
                    for($i = $t; $i < count($matches) - 1; $i+=2){
                    
                        $singleMatch= new Match();
                        $singleMatch->set_teams("Winner of " .$matches[$i]->get_matchId(), "Winner of " .$matches[$i+1]->get_matchId());
                        $singleMatch->set_matchId(count($matches2)+count($matches)+1);
                        array_push($matches2, $singleMatch);
                
                    }
                
                    $t = count($matches);
                    $matches = array_merge($matches, $matches2);
                }
                
                $matchesData['matches'] = $matches;
              
                break;

            case 'tournamentDoubleElimination':

                $id = 1;
                $numberOfTeams= count($teams);
                $x = floor(log(count($teams), 2));
                
                if(pow(2, $x) == $numberOfTeams){
                    $fullMatches = $numberOfTeams/2;
                } else {
                    $fullMatches = $numberOfTeams - pow(2, $x);
                }
                   
                for($i = 0; $i < $fullMatches; $i++){
                    $match = new Match();
                    $random_teams = array_rand($teams,2);
                    $match->set_teams($teams[$random_teams[0]], $teams[$random_teams[1]]);
                    array_push($matches, $match);
                    unset($teams[$random_teams[0]]);
                    unset($teams[$random_teams[1]]);
                }

                $emptyMatches = $numberOfTeams - 2 * $fullMatches;
              
                for($j = 0; $j < $emptyMatches; $j++){
                    $match = new Match();
                    $random_teams = array_rand($teams,1);
                    $team = "";
                    $match->set_teams($teams[$random_teams], $team);
                    array_push($matches, $match);
                    unset($teams[$random_teams]);
                }

                shuffle($matches);
                $id = 1;
                foreach($matches as $match){
                    $match->set_matchId($id);
                    $id += 1;
                }

               $matchesData['matches'] = $matches;
                
               $t = 0;
               $matchesData['winnerMatches'] = array();

                while($t != count($matches) - 1){
                    $matches2 = array();
                 
                    for($i = $t; $i < count($matches) - 1; $i+=2){
                    
                        $singleMatch= new Match();
                        $singleMatch->set_teams("Winner of " .$matches[$i]->get_matchId(), "Winner of " .$matches[$i+1]->get_matchId());
                        $singleMatch->set_matchId(count($matches2)+count($matches)+1);
                        array_push($matches2, $singleMatch);
                        array_push($matchesData['winnerMatches'], $singleMatch);
                
                    }
                 
                    $t = count($matches);
                    $matches = array_merge($matches, $matches2);
                }
                
                $matches = $matchesData['matches'];   
                $matchesData['loserMatches'] = array();                                                                         ;
                $t = 0;
                while($t != count($matches) - 1){
                    $matches2 = array();
                 
                    for($i = $t; $i < count($matches) - 1; $i+=2){
                    
                        $singleMatch= new Match();
                        $singleMatch->set_teams("Loser of " .$matches[$i]->get_matchId(), "Loser of " .$matches[$i+1]->get_matchId());
                        $singleMatch->set_matchId(count($matches2)+count($matches)+1);
                        array_push($matches2, $singleMatch);
                        array_push($matchesData['loserMatches'], $singleMatch);
                
                    }
    
                    $t = count($matches);
                    $matches = array_merge($matches, $matches2);
                }

                break;

        }
        return $matchesData;
    }
}

class Match{
    public $team1;
    public $team2;
    public $matchId;

    public function set_teams($team1, $team2) {
        $this->team1 = $team1;
        $this->team2 = $team2;
      }
    public function set_matchID($id){
        $this->matchId = $id;
    }
    public function get_team1(){
        return $this->team1;
    }
    public function get_team2(){
        return $this->team2;
    }
    public function get_matchId(){
        return $this->matchId;
    }
}
class Group{
  
    public $groupId;
    public $teams;

    public function set_teams($allTeams, $random_teams) {
        $x = 1;
        for($i = 0; $i < count($random_teams); $i++){
            $this->teams['team'.$x] = $allTeams[$random_teams[$i]];
            $x+=1;
        }
      
    }
    public function set_groupId($id){
        $this->groupId = $id;
    }
    public function set_additional_team($team){
        $i = count($this->teams) + 1;
        $this->teams['team'.$i] = $team;
    }
    public function get_teams(){
        return $this->teams;
    }
    public function get_groupId(){
        return $this->groupId;
    }
}