<?php
namespace App\Controller;

use App\Form\SurveyType;
use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\Survey;
use App\Module\Survey\SurveyFileStorage;
use App\Service\SurveyManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('get_survey.html.twig');
    }

    public function saveSurvey(): Response
    {
        $survey = new Survey();
        $form = $this->createForm(SurveyType::class, $survey);
        return $this->renderForm('save_survey.html.twig', ['form' => $form]);
    }
}
