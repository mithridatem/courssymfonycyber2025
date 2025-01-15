<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\ExempleService;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\WeatherType;
class ExempleController extends AbstractController
{
    public function __construct(
        private readonly ExempleService $exempleService
    )
    {}
    

    #[Route('/meteo', name: 'app_weather')]
    public function showWeather() : Response {

        return $this->render('exemple/meteo.html.twig',[
           'meteo' => $this->exempleService->getWeather() 
        ]);
    }

    #[Route('/meteo/city',name:'app_weather_city')]
    public function showWeatherByCity(Request $request) : Response {
        $meteo = "";
        $form = $this->createForm(WeatherType::class);
        $form->handleRequest($request);
        //Test si le formulaire est submit
        if($form->isSubmitted()) {
            //Récupération de la valeur de city
            //avec Request $request->request->all('weather')['city'],
            //avec Form $form->getData()['city'] 
            $meteo = $this->exempleService->getWeatherByCity($form->getData()['city']);
        }
        return $this->render('exemple/meteocity.html.twig',[
            'form' => $form,
            'meteo'=> $meteo
         ]);
    }
}
