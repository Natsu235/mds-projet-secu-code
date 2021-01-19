<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Redirige vers la page correspondante
     * 
     * @Route("/", name="home")
     */
    public function home() {
        if ($this->isGranted('ROLE_USER') == true) {
            $action = 'homepage';
        }
        else {
            $action = 'landing';
        }
        return $this->redirectToRoute($action);
    }

    /**
     * @Route("/homepage", name="homepage")
     * @Security("is_granted('ROLE_USER')")
     */
    public function homepage() {
        return $this->render('home/homepage.html.twig', [
        ]);
    }

    /**
     * @Route("/landing", name="landing")
     */
    public function landing() {
        return $this->render('home/landing.html.twig', [
        ]);
    }
}
