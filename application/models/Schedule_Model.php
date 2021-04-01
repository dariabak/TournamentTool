<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_Model extends CI_Model{
    public function createSchedule($data){
        $array = array();
        for($i = 0; $i < $data['numberOfTeams']; $i++){
            $teams = array($data['team' + $i]);
        }
        switch($data['typeOfSchedule']){
            case 'leagueRoundRobin':
                break;

            case 'tournamentSingleElimination':
                
          
                
                break;

            case 'tournamentDoubleElimination':
                break;
        }
    }
}