<?php

namespace App\Service;

use App\Module\Survey\Survey;

interface SurveyManagerInterface
{
    public function getSurvey(): ?Survey;

    public function saveSurvey(): string;
}