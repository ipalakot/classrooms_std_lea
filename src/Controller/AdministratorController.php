<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Article;
use App\Entity\Utilisateur;
use App\Entity\Categorie;
use App\Entity\Commentaire;

use App\Form\ArticleType;
use App\Form\UtilisateurType;
use App\Form\CategorieType;
use App\Form\CommentaireType;

use Doctrine\Common\Persistence\ObjectManager;
use PhpParser\Builder\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

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
    * @Route("/admin/listeArticle", name="listeArticle")
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
    * @Route("/admin/listeUtilisateur", name="listeUtilisateur")
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
    * @Route("/admin/listeCommentaire", name="listeCommentaire")
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
    * @Route("/admin/listeCategorie", name="listeCategorie")
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



    /**
    * @Route("/admin/article/nouveau", name="article.creation")
    */
    public function newArticle(Request $request, ObjectManager $manager)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

            /* $form = $this->createFormBuilder($article)
                ->add('title')
                ->add('content')
                ->add('image', null)
                ->getForm();
            */
                $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $article->setCreatedAt(new \DateTime());
            $manager->persist($article); 
            $manager->flush();
        }

        return $this->render('blog/form_article.html.twig', [ 
            'formCreatArticle' => $form->createView(),
            ]);
    }

    /**
    * @Route("/admin/article/{id}", name="article.edition")
    */
    public function modificationArticle(Article $article, Request $request, ObjectManager $manager)
    {
        $form = $this->createFormBuilder($article)
            ->add('title')
            ->add('content')
            ->add('image')
            ->getForm();
    
            $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($article); 
            $manager->flush();
            return $this->redirectToRoute('blog_show', ['id'=>$article->getId()]);
        }

        return $this->render('blog/form_article.html.twig', [ 
            'formCreatArticle' => $form->createView(),
            ]);
    }
    
    /**
    * @Route("/admin/article/{id}/", name="article.supression"): Response
    */
    public function deleteArticle(Article $article, Request $request, ObjectManager $manager)
    {
            $manager->remove($article); 
            $manager->flush();

        return $this->redirectToRoute('listeArticle');
    }

    /**
    * @Route("/admin/utilisateur/nouveau", name="utilisateur.creation")
    */
    public function newUtilisateur(Request $request, ObjectManager $manager)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);

        /* $form = $this->createFormBuilder($utilisateur)
            ->add('Nom')
            ->add('Prenom')
            ->add('dateDeNaissance')
            ->add('mail')
            ->add('Datelocation')
            ->add('Duree')
            ->getForm();
        */
            $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($utilisateur); 
            $manager->flush();
        }

        return $this->render('blog/form_utilisateur.html.twig', [ 
            'formCreatUtilisateur' => $form->createView(),
            ]);
    }

    /**
    * @Route("/admin/utilisateur/{id}/edition", name="utilisateur.edition")
    */
    public function modificationUtilisateur(Utilisateur $utilisateur, Request $request, ObjectManager $manager)
    {
        $form = $this->createFormBuilder($utilisateur)
            ->add('nom')
            ->add('prenom')
            ->add('datedenaissance')
            ->add('mail')
            ->add('datelocation')
            ->add('duree')
            ->add('password',  PasswordType::class)
            ->getForm();
    
            $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($utilisateur); 
            $manager->flush();
            //return $this->redirectToRoute('', ['id'=>$utilisateur->getId()]);
        }

        return $this->render('blog/form_utilisateur.html.twig', [ 
            'formCreatUtilisateur' => $form->createView(),
            ]);
    }

    /**
    * @Route("/admin/utilisateur/{id}/", name="utilisateur.supression"): Response
    */
    public function deleteUtilisateur(Utilisateur $utilisateur, Request $request, ObjectManager $manager)
    {
            $manager->remove($utilisateur); 
            $manager->flush();

        return $this->redirectToRoute('listeUtilisateur');
    }

    /**
    * @Route("/admin/categorie/nouveau", name="categorie.creation")
    */
    public function newCategorie(Request $request, ObjectManager $manager)
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);

        /* $form = $this->createFormBuilder($article)
            ->add('titre')
            ->add('resumer')
            ->getForm();
        */

            $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($categorie); 
            $manager->flush();
        }

        return $this->render('blog/form_categorie.html.twig', [ 
            'formCreatCategorie' => $form->createView(),
            ]);
    }

    /**
    * @Route("/admin/categorie/{id}/edition", name="categorie.edition")
    */
    public function modificationCategorie(Categorie $categorie, Request $request, ObjectManager $manager)
    {
        $form = $this->createFormBuilder($categorie)
            ->add('titre')
            ->add('resumer')
            ->getForm();
    
            $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($categorie); 
            $manager->flush();
            //return $this->redirectToRoute('', ['id'=>$utilisateur->getId()]);
        }

        return $this->render('blog/form_categorie.html.twig', [ 
            'formCreatCategorie' => $form->createView(),
            ]);
    }

    /**
    * @Route("/admin/categorie/{id}/", name="categorie.supression"): Response
    */
    public function deleteCategorie(Categorie $categorie, Request $request, ObjectManager $manager)
    {
            $manager->remove($categorie); 
            $manager->flush();

        return $this->redirectToRoute('listeCategorie');
    }

    /**
    * @Route("/admin/commentaire/nouveau", name="commentaire.creation")
    */
    public function newCommentaire(Request $request, ObjectManager $manager)
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);

            /* $form = $this->createFormBuilder($article)
                ->add('auteur')
                ->add('commentaire')
                ->getForm();
            */
                $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $commentaire->setCreatedAt(new \DateTime());
            $manager->persist($commentaire); 
            $manager->flush();
        }

        return $this->render('blog/form_commentaire.html.twig', [ 
            'formCreatCommentaire' => $form->createView(),
            ]);
        }

    /**
    * @Route("/admin/commentaire/{id}/edition", name="commentaire.edition")
    */
    public function modificationCommentaire(Commentaire $commentaire, Request $request, ObjectManager $manager)
    {
        $form = $this->createFormBuilder($commentaire)
            ->add('auteur')
            ->add('commentaire')
            ->getForm();
        
            $form->handleRequest($request);
            
        if($form->isSubmitted() && $form->isValid())
            {
                $manager->persist($commentaire); 
                $manager->flush();
                //return $this->redirectToRoute('', ['id'=>$utilisateur->getId()]);
            }

            return $this->render('blog/form_commentaire.html.twig', [ 
                'formCreatCommentaire' => $form->createView(),
                ]);
    }

    /**
    * @Route("/admin/commentaire/{id}/", name="commentaire.supression"): Response
    */
    public function deleteCommentarie(Commentaire $commentaire, Request $request, ObjectManager $manager)
    {
            $manager->remove($commentaire); 
            $manager->flush();

        return $this->redirectToRoute('listeCommentaire');
    }

}