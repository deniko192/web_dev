<?php
class SurveyFileStorage
{
    private const DIR_NAME = './data/';
    private const SEPARATOR = ':';

    public function load(string $email): ?Survey
    {
        $fileName = $this->createFileName($email);
        if (file_exists($fileName))
        {
            $lines = file($fileName);
            $surveyData = [];
            foreach ($lines as $line)
            {
                $value = explode(self::SEPARATOR, $line, 2);
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

        $fileName = $this->createFileName($survey->getEmail());
        return file_put_contents($fileName, $data) !== false;
    }

    private function createLine(string $key, ?string $value): string
    {
        return $key . self::SEPARATOR . ' ' . $value . PHP_EOL;
    }

    private function createFileName(string $email): string
    {
        return self::DIR_NAME . $email . '.txt';
    }
}