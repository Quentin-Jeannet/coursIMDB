<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/home/{nom}", name="app_front")
     */
    public function index($nom): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => $nom,
        ]);
    }
}
