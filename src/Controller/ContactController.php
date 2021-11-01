<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\ContactService;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, ContactService $contactService, EntityManagerInterface $Manager,
    MailerInterface $mailer): Response
    {
        $user = $this->getUser();
        $contact = new Contact();
        $form = $this->CreateForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $contactService->persisContact($contact);
            $Manager->flush();

            $email = (new Email())
            ->from(new Address('thms1601@gmail.com', 'Beauty Massage'))
            ->to($contact->getEmail())
            ->subject("Nouveau message")
            ->text("votre message à bien été transmis à l'équipe Beauty Massage merci ");
            
           $mailer->send($email);
          
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
