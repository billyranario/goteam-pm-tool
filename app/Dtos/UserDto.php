<?php 

namespace App\Dtos;

class UserDto extends BaseDto
{
    /**
     * @var int $id
     * @var string $name
     * @var string $email
     * @var string $password
     */
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id; 
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name; 
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email; 
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password; 
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id; 
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name; 
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email; 
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password; 
    }
}   