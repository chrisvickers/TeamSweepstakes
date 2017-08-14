<?php
/**
 * Created by PhpStorm.
 * User: chrisvickers
 * Date: 8/13/17
 * Time: 8:56 PM
 */

namespace App\Services;


class ScraperSportsTeam
{

    protected $name;

    protected $city;

    protected $link;

    protected $logo_url;


    /**
     * ScraperSportsTeam constructor.
     * @param $name
     * @param $city
     * @param $link
     * @param $logo_url
     */
    public function __construct($name,$city,$link,$logo_url = null)
    {
        $this->name = $name;
        $this->city = $city;
        $this->link = $link;
        $this->logo_url = $logo_url;
    }


    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }


    /**
     * @return null
     */
    public function getLogoUrl()
    {
        return $this->logo_url;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }


    /**
     * @param null $logo_url
     */
    public function setLogoUrl($logo_url)
    {
        $this->logo_url = $logo_url;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}