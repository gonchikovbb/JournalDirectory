<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'third_name',
    ];

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getThirdName(): string
    {
        return $this->third_name;
    }

    public function setFirstName(string $firstName)
    {
        $this->first_name = $firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->last_name = $lastName;
    }

    public function setThirdName(string $thirdName)
    {
        $this->third_name = $thirdName;
    }
}
