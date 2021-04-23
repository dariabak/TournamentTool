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
                $numberOfTeams = count($teams);
                $groups = array();
                if($numberOfTeams % 6 == 0){
                    $numberOfGroups = $numberOfTeams / 6;
                    for($i = 0; $i < $numberOfGroups; $i++){
                        $group = new Group();
                        $random_teams = array_rand($teams,6);
                        $group->set_teams($teams, $random_teams);
                        $group->set_groupId($i+1);
                        array_push($groups, $group);
                       
                    }
                } else if($numberOfTeams % 5 == 0){
                    $numberOfGroups = $numberOfTeams / 5;
                    for($i = 0; $i < $numberOfGroups; $i++){
                        $group = new Group();
                        $random_teams = array_rand($teams,5);
                        $group->set_teams($teams, $random_teams);
                        $group->set_groupId($i+1);
                        array_push($groups, $group);
                    }
                } else if($numberOfTeams % 4 == 0){
                    $numberOfGroups = $numberOfTeams / 4;
                    var_dump($numberOfGroups);
                    for($i = 0; $i < $numberOfGroups; $i++){
                        $group = new Group();
                        $random_teams = array_rand($teams,4);
                        $group->set_teams($teams, $random_teams);
                        $group->set_groupId($i+1);
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
               
               // $data = array();
                //$data['groups'] = $groups;
                //foreach($groups as $group){
                 //  $x = count($group)*(count($group) - 1)/2;
                  //   for($i = 0; $i < $x; $i++){
                  //     $match = new Match();
                  //      $random_teams = array_rand($group,2);
                   //     if($group[$random_teams[0]] != $group[$random_teams[1]]){

                   //     }
                   //   var_dump($x);

                   // }
                    //    }
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
                    array_push($array, $match);
                    unset($teams[$random_teams[0]]);
                    unset($teams[$random_teams[1]]);
                }

                $emptyMatches = $numberOfTeams - 2 * $fullMatches;
              
                for($j = 0; $j < $emptyMatches; $j++){
                    $match = new Match();
                    $random_teams = array_rand($teams,1);
                    $team = "";
                    $match->set_teams($teams[$random_teams], $team);
                    array_push($array, $match);
                    unset($teams[$random_teams]);
                }

                shuffle($array);
                $id = 1;
                foreach($array as $match){
                    $match->set_matchId($id);
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
        array_push($this->teams, $team);
    }
}