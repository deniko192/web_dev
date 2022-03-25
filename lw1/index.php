<?php
header('Content-Type: text/plain');
require_once('src/common.inc.php');

$surveyLoader = new RequestSurveyLoader();
$surveyFileManager = new SurveyFileStorage();
$surveyPrinter = new SurveyPrinter();

$survey = $surveyLoader->createSurvey();
$surveyEmail = $survey->getEmail();

echo('INPUT' . PHP_EOL);
$surveyPrinter->print($survey);

if ($surveyEmail !== null)
{
    $oldSurvey = $surveyFileManager->load($surveyEmail);

    if ($oldSurvey !== null)
    {
        echo(PHP_EOL . 'FILE_DATA' . PHP_EOL);
        $surveyPrinter->print($oldSurvey);
        if ($survey->getFirstName() === null)
        {
            $survey->setFirstName($oldSurvey->getFirstName());
        }
        if ($survey->getLastName() === null)
        {
            $survey->setLastName($oldSurvey->getLastName());
        }
        if ($survey->getAge() === null)
        {
            $survey->setAge($oldSurvey->getAge());
        }
    }
    
    echo(PHP_EOL . 'OUTPUT' . PHP_EOL);
    $surveyPrinter->print($survey);
    echo $surveyFileManager->save($survey)
        ? 'FILE SAVED'
        : 'SAVE ERROR';
}
else
{
    echo(PHP_EOL . 'Empty email value' . PHP_EOL);
}