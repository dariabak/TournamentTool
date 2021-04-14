<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_Model extends CI_Model{
    public function createSchedule($data){
        $array = array();
        $teams = array();
        
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
                break;

            case 'tournamentSingleElimination':
                $id = 1;
                    $numberOfTeams= count($teams);
                    $x = floor(log(count($teams), 2));
                
                    if(pow(2, $x) == $numberOfTeams){
                        $fullMatches = $numberOfTeams/2;
                        var_dump($fullMatches);
                    } else {
                        $fullMatches = $numberOfTeams - pow(2, $x);
                    }
                   

                    for($i = 0; $i < $fullMatches; $i++){
                        $match = new Match();
                        $random_teams = array_rand($teams,2);
                        $match->set_teams($teams[$random_teams[0]], $teams[$random_teams[1]]);
                        $match->set_matchId($id);
                        array_push($array, $match);
                        unset($teams[$random_teams[0]]);
                        unset($teams[$random_teams[1]]);
                        $id += 1;
                    }

                    $emptyMatches = $numberOfTeams - 2 * $fullMatches;
              
                    for($j = 0; $j < $emptyMatches; $j++){
                        $match = new Match();
                        $random_teams = array_rand($teams,1);
                        $team = "";
                        $match->set_teams($teams[$random_teams], $team);
                        $match->set_matchId($id);
                        array_push($array, $match);
                        unset($teams[$random_teams]);
                        $id += 1;
                    }

                
      
               $t = 0;
                
                while($t != count($array) - 1){
                    $matches = array();
                 
                    for($i = $t; $i < count($array) - 1; $i+=2){
                    
                        $singleMatch= new Match();
                        $singleMatch->set_teams("Winner of " .$array[$i]->get_matchId(), "Winner of " .$array[$i+1]->get_matchId());
                        $singleMatch->set_matchId(count($array)+count($matches)+1);
                        array_push($matches, $singleMatch);
                         
                            
                    }
                
                    $t = count($array);
                    $array = array_merge($array, $matches);
                }
                break;

            case 'tournamentDoubleElimination':
                $id = 1;
                while(count($teams) != 0){
                    
                    $match = new Match();
                    if(count($teams) != 1){
                        $random_teams = array_rand($teams,2);
                        $match->set_teams($teams[$random_teams[0]], $teams[$random_teams[1]]);
                        $match->set_matchId($id);
                        array_push($array, $match);
                        unset($teams[$random_teams[0]]);
                        unset($teams[$random_teams[1]]);
                    } else {
                        $random_teams = array_rand($teams,1);
                        $team = "";
                        $match->set_teams($teams[$random_teams], $team);
                        $match->set_matchId($id);
                        array_push($array, $match);
                        unset($teams[$random_teams]);
                    }
                    $id += 1;
                }
                break;
        }

    
        return $array;
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