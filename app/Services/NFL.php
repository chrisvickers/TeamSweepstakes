<?php

namespace App\Services;


use App\League;
use App\Sport;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;

class NFL extends BaseSportsScraper implements SportsScraper
{


    protected $base_url = 'http://www.nfl.com/standings';


    public function __construct()
    {
        $this->setup_components();
        parent::__construct();
    }


    public function showTeam($team_name)
    {
        // TODO: Implement showTeam() method.
    }


    public function listTeams($page = 1, $limit = 10)
    {
        $table = $this->driver->get($this->base_url)->findElement(WebDriverBy::className('grid'));

        $return = collect();

        $teams = $table->findElements(WebDriverBy::className('tbdy1'));
        sleep(1);

        foreach ($teams as $team){
            $team_link = $team->findElement(WebDriverBy::tagName('a'));
            $text = $team_link->getText();
            if($text != null){
                $text = explode(' ',$text);
                $link = $team_link->getAttribute('href');



                $team_obj = new ScraperSportsTeam(array_pop($text),implode(' ',$text),$link);


                $return->push($team_obj);
            }
        }

        $return->each(function($team){
            $logo_path = $this->driver->get($team->getLink());
            $logo = $logo_path->findElement(WebDriverBy::className('team-logo'))
                ->findElement(WebDriverBy::tagName('img'))->getAttribute('src');

            $team->setLogoUrl($logo);
        });

        return $return;

    }


    public function showStats($team_id)
    {
        // TODO: Implement showStats() method.
    }



    public function setup_components()
    {
        $this->sport = Sport::query()->where('name','Football')->first();
        if(!$this->sport){
            $this->sport = Sport::query()->create([
                'name'  =>  'Football'
            ]);
        }

        $this->league = League::query()->where('name','NFL')
            ->where('sport_id',$this->sport->id)->first();

        if(!$this->league) {
            League::query()->create([
                'sport_id' => $this->sport->id,
                'name' => 'NFL'
            ]);
    }

    }

}