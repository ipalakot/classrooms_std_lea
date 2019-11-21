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
use Symfony\Component\HttpFoundation\Request;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {

        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles =  $paginator->paginate(
            $repo->findAll(), 
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=> $articles
        ]);
    }


    /**
    * @Route("/article/nouveau", name="article.creation")
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
    * @Route("/article/{id}/edition", name="article.edition")
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
    * @Route("/utilisateur/nouveau", name="utilisateur.creation")
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
    * @Route("/utilisateur/{id}/edition", name="utilisateur.edition")
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
    * @Route("/categorie/nouveau", name="categorie.creation")
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
    * @Route("/categorie/{id}/edition", name="categorie.edition")
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
    * @Route("/commentaire/nouveau", name="commentaire.creation")
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
    * @Route("/commentaire/{id}/edition", name="commentaire.edition")
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
    * @Route("/blog_show/{id}", name="blog_show")
    */
    public function blog_show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);

        return $this->render('blog/blog_show.html.twig', [
            'controller_name' => 'BlogController',
            'article'=> $article,
        ]);
    }


}