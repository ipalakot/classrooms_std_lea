<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {

        $repo = $this->getDoctirne()->getRepository(ArticleRepository::class);
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=> $articles,
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
