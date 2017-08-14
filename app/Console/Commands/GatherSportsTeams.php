<?php

namespace App\Console\Commands;

use App\Services\NFL;
use App\SportsTeam;
use Illuminate\Console\Command;

class GatherSportsTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sports:scrape {sport}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        $sport = $this->argument('sport');


        switch (strtolower($sport)){

            case 'nfl':
                $sport_scraper = new NFL();
                break;

            default:
                $this->error('Please select a valid sport');
                return;

        }


        if(isset($sport_scraper)){

            $teams = $sport_scraper->listTeams();

            dd($teams->first());

            if(isset($teams)){
                $bar = $this->output->createProgressBar($teams->count());

                foreach ($teams as $team){

                    $sport_team = SportsTeam::query()->where('league_id',$sport_scraper->getLeague()->id)
                        ->where('name',$team->getName())
                        ->where('city',$team->getCity())->first();

                    if(!$sport_team){
                        $sport_team = SportsTeam::create([
                            'league_id' =>  $sport_scraper->getLeague()->id,
                            'name'      =>  $team->getName(),
                            'city'      =>  $team->getCity(),
                        ]);
                    }

                    $sport_team->logo_url = $team->getLogoUrl();
                    $sport_team->save();

                    $bar->advance();


                }

                $bar->finish();
            }



        }




    }

}
