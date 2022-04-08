<?php
namespace App\Controller;

use App\Modules\RequestSurveyLoader;
use App\Modules\SurveyFileStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetSurveyController extends AbstractController
{
    public function get() :Response
    {
        $surveyLoader = new RequestSurveyLoader($_GET);
        $surveyFileStorage = new SurveyFileStorage('../src/data/');
        $survey = $surveyLoader->getSurvey();
        return $this->render(
            'get_survey.html.twig',
            ['survey' => $survey === null ? $survey : $surveyFileStorage->load($survey->getEmail())]);
    }
}
