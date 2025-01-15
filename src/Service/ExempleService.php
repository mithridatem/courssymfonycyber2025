<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExempleService
{
    public function __construct(
        private readonly string $apiKey,
        private readonly HttpClientInterface $httpClient
    ) {}

    public function getWeather(): array
    {
        $content = $this->httpClient->request(
            'GET',
            'https://api.openweathermap.org/data/2.5/weather?lon=1.44&lat=43.6&appid=' . $this->apiKey
        );

        return $content->toArray();
    }

    public function getWeatherByCity(string $city) : array {
        //récupération des données météo en fonction de la ville
        try {
            //récupération de la réponse de l'api
            $response = $this->httpClient->request(
                'GET',
                'https://api.openweathermap.org/data/2.5/weather?q=' .$city. '&appid=' .$this->apiKey
            );
            //converion en tableau de la réponse de l'api
            $data = $response->toArray();
        } 
        //gestion des erreurs si code autre que 200 et 300
        catch (\Throwable $th) {
            //test si le code est 404 ou 400
            if($th->getCode() == 404 OR $th->getCode() == 400){
                //retouner le tableau d'erreur
                $data = ['cod'=>$th->getCode(),
                'message'=>$th->getCode() == 404?$city.' n\'existe pas':'le champs est vide'];
            }
        }
        //return du tableau
        return $data;
    }
    
}
