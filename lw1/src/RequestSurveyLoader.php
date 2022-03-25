<?php
class RequestSurveyLoader
{
    public function createSurvey(): Survey
    {
        $email = isset($_GET['email']) && !empty($_GET['email'])
            ? $_GET['email']
            : null;
        $firstName = $_GET['first_name'] ?? null;
        $lastName = $_GET['last_name'] ?? null;
        $age = $_GET['age'] ?? null;
        return new Survey($email, $firstName, $lastName, $age);
    }
}