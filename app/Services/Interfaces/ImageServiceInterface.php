<?php

namespace App\Services\Interfaces;

interface ImageServiceInterface
{
    /**
     * @param string $prompt
     * @return mixed
     */
    public function generateImage(string $prompt);

}
