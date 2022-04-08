<?php
namespace App\Controller;

use App\Modules\RequestSurveyLoader;
use App\Modules\SurveyFileStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SaveSurveyController extends AbstractController
{
    public function save(): Response
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





