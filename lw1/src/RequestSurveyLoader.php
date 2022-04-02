<?php
class RequestSurveyLoader
{
    private array $surveyData;

    public function  __construct(array $params)
    {
        foreach ($params as $param)
        {
            $this->surveyData[$param] = isset($_GET[$param]) && !empty($_GET[$param])
                ? $_GET[$param]
                : null;
        }
    }

    public function getSurvey(): Survey
    {
        return new Survey($this->surveyData['email'], $this->surveyData['first_name'], $this->surveyData['last_name'], $this->surveyData['age']);
    }
}