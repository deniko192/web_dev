<?php
namespace App\Module\Survey;

use App\Module\RuntimeException;

class SurveyFileStorage implements SurveyFileStorageInterface
{
    private string $dirName;
    private string $separator;

    public function __construct(string $dirName = '../src/data/', string $separator = ':')
    {
        $this->dirName = $dirName;
        $this->separator = $separator;
    }

    public function load(string $email): ?Survey
    {
        $fileName = $this->getFullPath($email);
        if (file_exists($fileName))
        {
            $lines = file($fileName);
            $surveyData = [];
            foreach ($lines as $line)
            {
                $value = explode($this->separator, $line);
                $surveyData[$value[0]] = trim($value[1]);
            }

            return new Survey(
                $surveyData['Email'],
                $surveyData['First Name'],
                $surveyData['Last Name'],
                $surveyData['Age'],
            );
        }

        return null;
    }

    public function save(Survey $survey): bool
    {
        $data = $this->createLine('Email', $survey->getEmail()) .
            $this->createLine('First Name', $survey->getFirstName()) .
            $this->createLine('Last Name', $survey->getLastName()) .
            $this->createLine('Age', $survey->getAge());

        if (!file_exists($this->dirName) && !mkdir($concurrentDirectory = $this->dirName) && !is_dir($concurrentDirectory))
        {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }
        $fileName = $this->getFullPath($survey->getEmail());
        return file_put_contents($fileName, $data) !== false;
    }

    private function createLine(string $key, ?string $value): string
    {
        return $key . $this->separator . ' ' . $value . PHP_EOL;
    }

    private function getFullPath(string $email): string
    {
        return $this->dirName . $email . '.txt';
    }
}