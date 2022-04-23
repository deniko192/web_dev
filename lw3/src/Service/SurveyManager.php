<?php
namespace App\Service;

use App\Module\Survey\SurveyFileStorage;
use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\Survey;

class SurveyManager implements SurveyManagerInterface
{
    private RequestSurveyLoader $surveyLoader;
    private SurveyFileStorage $surveyFileStorage;

    public function __construct()
    {
        $this->surveyLoader = new RequestSurveyLoader();
        $this->surveyFileStorage = new SurveyFileStorage();
    }

    public function getSurvey(): ?Survey
    {
        $survey = $this->surveyLoader->getSurvey();
        return $survey === null
            ? $survey
            : $this->surveyFileStorage->load($survey->getEmail());
    }

    public function saveSurvey(): string
    {
        return '';
    }
}