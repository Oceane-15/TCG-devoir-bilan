<?php

class PageController
{
    public function accueil(): void
    {
        require __DIR__ . '/../views/accueil.php';
    }

    public function mentions(): void
    {
        require __DIR__ . '/../views/mentions.php';
    }

    public function cgv(): void
    {
        require __DIR__ . '/../views/cgv.php';
    }
}