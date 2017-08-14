<?php
/**
 * Created by PhpStorm.
 * User: chrisvickers
 * Date: 8/13/17
 * Time: 4:14 PM
 */

namespace App\Services;


use App\Traits\InteractsWithRemoteWebDriver;

class BaseSportsScraper
{
    use InteractsWithRemoteWebDriver;

    /**
     * Return League
     * @var
     */
    protected $league;

    /**
     * Return Sport
     * @var
     */
    protected $sport;

    /**
     * BaseSportsScraper constructor.
     */
    public function __construct()
    {
        exec('ps aux | grep chrome | awk \' { print $2 } \' | xargs kill -9');
        exec('ps aux | grep chromium | awk \' { print $2 } \' | xargs kill -9');
        $this->start_driver();
    }


    /**
     * Return Sport
     * @return mixed
     */
    public function getSport(){
        return $this->sport;
    }

    /**
     * Return League
     * @return mixed
     */
    public function getLeague(){
        return $this->league;
    }


}