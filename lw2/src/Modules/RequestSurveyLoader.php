<?php
namespace App\Modules;

class RequestSurveyLoader
{
    private array $request;

    public function  __construct(array $request)
    {
        $this->request = $request;
    }

    public function getSurvey(): ?Survey
    {
        $email = $this->getGetParameter('email');
        return $email === null
        ? null
        : new Survey(
            $email,
            $this->getGetParameter('first_name'),
            $this->getGetParameter('last_name'),
            $this->getGetParameter('age')
        );
    }
    
    private function getGetParameter(string $param): ?string
    {
        return isset($this->request[$param]) && !empty($this->request[$param])
            ? $this->request[$param]
            : null;
    }   
}
