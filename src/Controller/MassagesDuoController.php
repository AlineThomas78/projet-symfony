<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MassagesDuoController extends AbstractController
{
    /**
     * @Route("/massages/ duo", name="massages_duo")
     */
    public function index(): Response
    {
        return $this->render('massages_duo/index.html.twig', [
            'controller_name' => 'MassagesDuoController',
        ]);
    }
}
