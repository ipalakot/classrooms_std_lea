<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Utilisateur;
use App\Entity\Categorie;

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
    
        return $this->render('administrator/edit_article.html.twig', [
            'controller_name' => 'AdministratorController',
            'articles'=> $articles
        ]);
    }

    /**
    * @Route("/listeUtilisateur", name="listeUtilisateur")
    */
    public function listeUtilisateur()
    {

        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateurs = $repo->findAll();
    
        return $this->render('administrator/edit_utilisateur.html.twig', [
            'controller_name' => 'AdministratorController',
            'utilisateurs'=> $utilisateurs
        ]);
    }

    /**
    * @Route("/listeCommentaire", name="listeCommentaire")
    */
    public function listeCommentaire()
    {

        $repo = $this->getDoctrine()->getRepository(Commentaire::class);
        $commentaires = $repo->findAll();
    
        return $this->render('administrator/edit_commentaire.html.twig', [
            'controller_name' => 'AdministratorController',
            'commentaires'=> $commentaires
        ]);
    }

    /**
    * @Route("/listeCategorie", name="listeCategorie")
    */
    public function listeCategorie()
    {

        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $categories = $repo->findAll();
    
        return $this->render('administrator/edit_categorie.html.twig', [
            'controller_name' => 'AdministratorController',
            'categories'=> $categories
        ]);
    }
}