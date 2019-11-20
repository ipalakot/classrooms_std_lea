<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Article;
use App\Entity\Utilisateur;
use App\Entity\Categorie;

use App\Form\ArticleType;
use App\Form\UtilisateurType;

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

/*        $form = $this->createFormBuilder($article)
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
    * @Route("/Utilisateur/nouveau", name="utilisateur.nouveau")
    */
    public function newUtilisateur(Request $request, ObjectManager $manager)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);

        //$form = $this->createFormBuilder($utilisateur)
            // ->add('Nom')
            // ->add('Prenom')
            // ->add('dateDeNaissance')
            // ->add('mail')
            // ->add('Datelocation')
            // ->add('Duree')
            // ->getForm();

                $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
         
            $manager->persist($utilisateur); 
            $manager->flush();
         
         //   return $this->render('blog/utilisateur.html.twig');
        }

        return $this->render('blog/newUtilisateur.html.twig', [ 
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
                return $this->redirectToRoute('', ['id'=>$utilisateur->getId()]);
            }

            return $this->render('blog/form_utilisateur.html.twig', [ 
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