<?php
namespace App\Repository;

interface UserInterface 
{
    public function createUser($collection = []);
    public function createNewToken($token = []);
}