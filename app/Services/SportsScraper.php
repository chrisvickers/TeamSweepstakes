<?php

namespace App\Services;

interface SportsScraper
{

    public function listTeams($page = 1, $limit = 10);


    public function showTeam($team_name);


    public function showStats($team_id);


    public function setup_components();

}