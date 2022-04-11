<?php
namespace App\Controller;

use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\SurveyFileStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends AbstractController
{
    public function getSurvey(): Response
    {
        $surveyLoader = new RequestSurveyLoader($_GET);
        $surveyFileStorage = new SurveyFileStorage('../src/data/');
        $survey = $surveyLoader->getSurvey();
        return $this->render(
            'get_survey.html.twig',
            ['survey' => $survey === null ? $survey : $surveyFileStorage->load($survey->getEmail())]);
    }

    public function saveSurvey(): Response
    {
        $surveyLoader = new RequestSurveyLoader($_GET);
        $surveyFileStorage = new SurveyFileStorage('../src/data/');
        $survey = $surveyLoader->getSurvey();
        if ($survey === null)
        {
            return $this->render('save_survey.html.twig', ['message' => 'Пустое значение email']);
        }
        $fileSaved = $surveyFileStorage->save($survey);
        return $this->render(
            'save_survey.html.twig',
            ['message' => $fileSaved ? 'Данные сохранены' : 'Ошибка при сохранении файла']);
    }
}
