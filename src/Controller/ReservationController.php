<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\MassageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(Request $request,MassageRepository $massageRepository, EntityManagerInterface $Manager, SessionInterface $session)
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        $reservation = new Reservation();
        $user = $this->getUser();
        $reservation->setUser($user);
        $reservation->setCreatedAt(new \DateTime());
        $reservation->setReservationAt(new \DateTime());


        $form = $this->createForm(ReservationType::class, $reservation);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $panier = $session->get('panier', []);
            foreach($panier as $massageId => $nombre){
              $massage = $massageRepository->find($massageId);
              $reservation->addReservationMassage($massage);
            }
            $Manager->persist($reservation);
            $Manager->flush();

            return $this->redirectToRoute('accueil');
        }
        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
