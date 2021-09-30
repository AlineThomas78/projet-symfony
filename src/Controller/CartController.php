<?php

namespace App\Controller;

use App\Repository\MassageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(SessionInterface $session, MassageRepository $massageRepository)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach($panier as $id => $quantity){
            $panierWithData[] = [ 
                'massage' => $massageRepository->find($id),
                'quantity' => $quantity
            ];
        }
       
        $total = 0;

        foreach($panierWithData as $item){
            $totalItem = $item['massage']->getPrice1() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }


    /**
     * @Route("/panier/add/{id}/{price}", name="cart_add")
     */
    public function Add($id, SessionInterface $session){

        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/panier/decrease/{id}", name="cart_decrease")
     */
    public function decrease($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
           $panier[$id]-=1;

           if($panier[$id] == 0){
            unset($panier[$id]);
           }
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute("cart_index");
    }


     /**
     * @Route("/panier/increase/{id}", name="cart_increase")
     */
    public function increase($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]+=1;
        } 
        
        $session->set('panier', $panier);
        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/reservation", name="reservation")
     */
    public function reservation(SessionInterface $session){
        $panier = $session->get('panier', []);
    

        return $this->redirectToRoute("cart_index");
    }
}
