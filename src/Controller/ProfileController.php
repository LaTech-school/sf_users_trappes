<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * Route(
     * "/mon-profile", <--- path : site.com/mon-profile
     * name="profile" <---- name : <a href="{{ path('profile') }}">..
     * )
     */



    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        // Test l'identité de l'utilisateur
        if (!$this->getUser())
        {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
}
