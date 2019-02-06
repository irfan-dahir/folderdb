<?php

namespace FolderDb;

use Symfony\Component\Dotenv\Dotenv;

class Client
{

    public function __construct($dotEnvPath = null)
    {
        $dotenv = new Dotenv();
        $dotenv->load($dotEnvPath ?? __DIR__.'/.env');
    }
}