<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="pages")
     */
    public function homepage()
    {
        return $this->render('pages/homepage.html.twig');
    }
}
