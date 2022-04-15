<?php

namespace App\Module\Survey;

interface RequestSurveyLoaderInterface
{
    public function __construct(array $request = null);

    public function getSurvey(): ?Survey;
}