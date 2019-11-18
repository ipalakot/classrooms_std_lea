<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Article;
use App\Entity\Utilisateur;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

use Knp\Component\Pager\PaginatorInterface;

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
    * @Route("/newArticle", name="nouvelleArticle")
    */
    public function newArticle(Article $article = null, Request $request, ObjectManager $manager)
    {
        $article = new Article();
        $form = $this->createFormBuilder($article)

                ->add('title')
                ->add('content')
                ->add('image', null)

                ->getForm();

                $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $article->setCreatedAt(new \DateTime());
            $manager->persist($article); 
            $manager->flush();
        }

        return $this->render('blog/newArticle.html.twig', [ 
            'formCreatArticle' => $form->createView(),
            ]);
    }


    /**
    * @Route("/newUtilisateur", name="nouvelleUtilisateur")
    */
    public function newUtilisateur(Request $request, ObjectManager $manager)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createFormBuilder($utilisateur)

                ->add('Nom')
                ->add('Prenom')
                ->add('dateDeNaissance')
                ->add('mail')
                ->add('Datelocation')
                ->add('Duree')

                ->getForm();

                $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
         
            $manager->persist($utilisateur); 
            $manager->flush();

        }

        return $this->render('blog/newUtilisateur.html.twig', [ 
            'formCreatUtilisateur' => $form->createView(),
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