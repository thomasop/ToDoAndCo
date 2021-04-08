<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage", methods={"GET"})
     *
     * Method - indexAction
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('home/home.html.twig');
    }
}
