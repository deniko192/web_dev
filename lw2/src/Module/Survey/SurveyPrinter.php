<?php
namespace App\Module\Survey;

class SurveyPrinter
{
    public function print(Survey $survey): void
    {
        echo(
            'Email: ' . $survey->getEmail() . PHP_EOL .
            'First Name: ' . $survey->getFirstName() . PHP_EOL .
            'Last Name: ' . $survey->getLastName() . PHP_EOL .
            'Age: ' . $survey->getAge() . PHP_EOL
        );
    }
}
