<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonPannierController extends AbstractController
{
    /**
     * @Route("/mon/pannier", name="mon_pannier")
     */
    public function index(): Response
    {
        return $this->render('mon_pannier/index.html.twig', [
            'controller_name' => 'MonPannierController',
        ]);
    }
}
