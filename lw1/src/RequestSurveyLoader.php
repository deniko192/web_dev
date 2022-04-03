<?php
class RequestSurveyLoader
{
    private array $surveyData;

    public function  __construct(array $params)
    {
        foreach ($params as $param)
        {
            $this->surveyData[$param] = $this->getGetParameter($param); 
        }
    }

    public function getSurvey(): ?Survey
    {
        return $this->surveyData['email']
            ?? new Survey($this->surveyData['email'], $this->surveyData['first_name'], $this->surveyData['last_name'], $this->surveyData['age']);
    }
    
    private function getGetParameter(string $param): ?string
    {
        return isset($_GET[$param]) && !empty($_GET[$param])
            ? $_GET[$param]
            : null;
    }   
}
