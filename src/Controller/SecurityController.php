<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security")
     */
     public function registration(Request $request, EntityManagerInterface $Manager,
     UserPasswordEncoderInterface $encoder, MailerInterface $mailer, FlashBagInterface $flash){
         $user = new User();

         $form = $this->createForm(RegistrationType::class, $user);
         $form->handleRequest($request);
       
         if($form->isSubmitted() && $form->isValid()){
             $hash =$encoder->encodePassword($user, $user->getPassword());
             $user->setUsername($user->getEmail());
             $user->setRoles(array("ROLE_USER"));
             $user->setPassword($hash);

             $Manager->persist($user);
             $Manager->flush();
            
             $email = (new Email())
             ->from(new Address('thms1601@gmail.com', 'Beauty Massage'))
             ->to($user->getEmail())
             ->subject("Confirmation d'inscription")
             ->text('hello ');
             
            $mailer->send($email);
            $flash->add('success', 'votre inscription à bien été prise en compte. Merci');
             return $this->redirectToRoute('app_login');
         }
         

         return $this->render('security/registration.html.twig', [
             'form' => $form->createView()
         ]);
     }

     /**
      * @Route("/login", name="app_login")
      */
     public function login(AuthenticationUtils $authenticationUtils): Response
     {
         // if ($this->getUser()) {
         //     return $this->redirectToRoute('target_path');
         // }

         // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();
         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();

         return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
     }

     /**
      * @Route("/logout", name="app_logout")
      */
     public function logout()
     {
         throw new \LogicException('This method can be blank');
     }

}
