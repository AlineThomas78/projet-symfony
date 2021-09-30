<?php

namespace App\Controller;

use App\Repository\MassageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MassageController extends AbstractController
{
    /**
     * @Route("/massage", name="massage")
     */
    public function index(MassageRepository $massageRepository)
    {
        return $this->render('massage/index.html.twig', [
            'massage' => $massageRepository->findAll()
        ]);
        
    }
}
