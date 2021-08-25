<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MassagesController extends AbstractController
{
    /**
     * @Route("/massages", name="massages")
     */
    public function index(): Response
    {
        return $this->render('massages/index.html.twig', [
            'controller_name' => 'MassagesController',
        ]);
    }
}
