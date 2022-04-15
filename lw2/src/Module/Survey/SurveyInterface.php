<?php

namespace App\Module\Survey;

interface SurveyInterface
{
    public function __construct(string $email, ?string $first_name, ?string $last_name, ?string $age);

    public function getEmail(): string;

    public function getFirstName(): ?string;

    public function getLastName(): ?string;

    public function getAge(): ?string;

    public function setFirstName(string $first_name): void;

    public function setLastName(string $last_name): void;

    public function setAge(string $age): void;
}