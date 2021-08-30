<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReinitialiserMdpController extends AbstractController
{
    /**
     * @Route("/reinitialiser_mdp", name="reinitialiser_mdp")
     */
    public function index(): Response
    {
        return $this->render('reinitialiser_mdp/index.html.twig', [
            'controller_name' => 'ReinitialiserMdpController',
        ]);
    }
}
