<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeConnecterController extends AbstractController
{
    /**
     * @Route("/me/connecter", name="me_connecter")
     */
    public function index(): Response
    {
        return $this->render('me_connecter/index.html.twig', [
            'controller_name' => 'MeConnecterController',
        ]);
    }
}
