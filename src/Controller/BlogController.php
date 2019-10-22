<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
    * @Route("/blog_show", name="blog_show")
    */
    public function blog_show()
    {
        return $this->render('blog/blog_show.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
}
