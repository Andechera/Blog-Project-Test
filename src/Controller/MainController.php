<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// MainController gestisce solo la pagina principale.
class MainController extends AbstractController
{
    // Definizione rotta per accedere al sito, pagina iniziale
    #[Route('/', name: 'app_main')]
    // Metodo per definire la paginina iniziale del blog.
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }
}
