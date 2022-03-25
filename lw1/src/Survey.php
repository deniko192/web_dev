<?php
class Survey
{
    private ?string $email, $first_name, $last_name, $age;

    public function __construct(?string $email, ?string $first_name, ?string $last_name, ?string $age)
    {
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->age = $age;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function setAge(string $age): void
    {
        $this->age = $age;
    }
}