<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class AdministratorController extends AbstractController
{
    /**
     * @Route("/admin", name="administrateur")
     */
    public function index()
    {
        return $this->render('administrator/index.html.twig', [
            'controller_name' => 'AdministratorController',
        ]);
    }

    /**
    * @Route("/listeArticle", name="listeArticle")
    */
    public function listeArtilce()
    {

        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();
    
        return $this->render('administrator/edit_Article.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=> $articles
        ]);
    }
}