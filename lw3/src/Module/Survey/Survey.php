<?php
namespace App\Module\Survey;

class Survey
{
    private ?string $email;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $age;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setFirstName(string $first_name): void
    {
        $this->firstName = $first_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->lastName = $last_name;
    }

    public function setAge(string $age): void
    {
        $this->age = $age;
    }
}
