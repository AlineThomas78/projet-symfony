<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Repository\MassageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(Request $request,MassageRepository $massageRepository, EntityManagerInterface $Manager,
     SessionInterface $session, MailerInterface $mailer, FlashBagInterface $flash)
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

            $email = (new Email())
            ->from(new Address('thms1601@gmail.com', 'Beauty Massage'))
            ->to($user->getEmail())
            ->subject("Confirmation de réservation")
            ->text('hello ');
            
           $mailer->send($email);

           $flash->add('success', 'votre réservation à bien été prise en compte. Merci');
            return $this->redirectToRoute('accueil');
        }
        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
