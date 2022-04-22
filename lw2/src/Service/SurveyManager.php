<?php
namespace App\Service;

use App\Module\Survey\SurveyFileStorageInterface;
use App\Module\Survey\RequestSurveyLoaderInterface;
use App\Module\Survey\Survey;

class SurveyManager implements SurveyManagerInterface
{
    private RequestSurveyLoaderInterface $surveyLoader;
    private SurveyFileStorageInterface $surveyFileStorage;

    public function __construct(RequestSurveyLoaderInterface $surveyLoader, SurveyFileStorageInterface $surveyFileStorage)
    {
        $this->surveyLoader = $surveyLoader;
        $this->surveyFileStorage = $surveyFileStorage;
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
        $survey = $this->surveyLoader->getSurvey();
        if (!$survey)
        {
            throw new Exception('Пустое значение email');
        }
        return $this->surveyFileStorage->save($survey)
            ? 'Данные сохранены'
            : 'Ошибка при сохранении файла';
    }
}