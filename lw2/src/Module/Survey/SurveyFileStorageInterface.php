<?php

namespace App\Module\Survey;

interface SurveyFileStorageInterface
{
    public function __construct(string $dirName = './data/', string $separator = ':');

    public function load(string $email): ?Survey;

    public function save(Survey $survey): bool;
}