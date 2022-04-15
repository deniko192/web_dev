<?php
namespace App\Controller;

use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\SurveyFileStorage;
use App\Service\SurveyManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends AbstractController
{
    private SurveyManagerInterface $surveyManager;

    public function __construct(SurveyManagerInterface $surveyManager)
    {
        $this->surveyManager = $surveyManager;
    }

    public function getSurvey(): Response
    {
        return $this->render('get_survey.html.twig', ['survey' => $this->surveyManager->getSurvey()]);
    }

    public function saveSurvey(): Response
    {
        return $this->render('save_survey.html.twig', ['message' => $this->surveyManager->saveSurvey()]);
    }
}
