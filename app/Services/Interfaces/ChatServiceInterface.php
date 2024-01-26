<?php

namespace App\Services\Interfaces;


use App\Models\User;

interface ChatServiceInterface
{
    public function generatePrompt($userKeyword);

}
