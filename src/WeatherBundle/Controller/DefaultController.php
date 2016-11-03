<?php

namespace WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/weather/{city}")
     */
    public function cityAction($city)
    {


        $json_string = file_get_contents("http://api.wunderground.com/api/3d9ff99fc369c36b/geolookup/conditions/q/IA/${city}.json");
        $parsed_json = json_decode($json_string);
        $location = $parsed_json->{'location'}->{'city'};
        $temp_c = $parsed_json->{'current_observation'}->{'temp_c'};
        echo "Current temperature in ${location} is: ${temp_c}\n";
        return $this->render('WeatherBundle:Default:index.html.twig');
    }
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('WeatherBundle:Default:index.html.twig');
    }
    /**
     * @Route("/weather")
     */
    public function inputAction()
    {

        $city = $_POST["city"];
        if (!$city) {echo "error";}
        $json_string = file_get_contents("http://api.wunderground.com/api/3d9ff99fc369c36b/geolookup/conditions/q/IA/${city}.json");
        $parsed_json = json_decode($json_string);
        $location = $parsed_json->{'location'}->{'city'};
        $temp_c = $parsed_json->{'current_observation'}->{'temp_c'};
        echo "Current temperature in ${location} is: ${temp_c}\n";
        return $this->render('WeatherBundle:Default:index.html.twig');
    }
}
