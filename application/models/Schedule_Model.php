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
                
            while(count($teams) != 0){
                $random_teams = array_rand($teams,2);
                $array[$teams[$random_teams[0]]] = $teams[$random_teams[1]];
                unset($teams[$random_teams[0]]);
                unset($teams[$random_teams[1]]);
            }
           
                break;

            case 'tournamentDoubleElimination':
                while(count($teams) != 0){
                    $random_teams = array_rand($teams,2);
                    $array[$teams[$random_teams[0]]] = $teams[$random_teams[1]];
                    unset($teams[$random_teams[0]]);
                    unset($teams[$random_teams[1]]);
                }
                break;
        }

        var_dump($array);
        return $array;
    }
}