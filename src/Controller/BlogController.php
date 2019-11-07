<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Article;
use App\Entity\Commentaire;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {

        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=> $articles
        ]);
    }

    /**
    * @Route("/blog_show/{id}", name="blog_show")
    */
    public function blog_show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);
   
        $repo1 = $this->getDoctrine()->getRepository(Commentaire::class);
        $commentaire = $repo1->find($id);

        return $this->render('blog/blog_show.html.twig', [
            'controller_name' => 'BlogController',
            'article'=> $article,
            'commentaire'=> $commentaire,
        ]);
    }
}
