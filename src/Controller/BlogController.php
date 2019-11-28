<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;

use App\Form\CommentaireType;
use PhpParser\Builder\Method;

use Knp\Component\Pager\PaginatorInterface;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    * @Route("/blog_show/{id}", name="blog_show")
    */
    public function blog_show($id, ObjectManager $manager,  Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $repo1 = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);
        $articles = $repo1->findAll();

        $commentaire = new Commentaire();
        
        $form = $this->createFormBuilder($commentaire)
            ->add('auteur')
            ->add('commentaire')
            ->add('createdAt', DateType::class)
            ->getForm();

            $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $commentaire->setCreatedAt(new \DateTime());
            $manager->persist($commentaire); 
            $manager->flush();
            return $this->redirectToRoute('blog_show', ['id'=>$article->getId()]);
        }

        return $this->render('blog/blog_show.html.twig', [
            'controller_name' => 'BlogController',
            'article'=> $article,
            'articles'=> $articles,
            'commentaire'=>$commentaire,
            'formCommentaire' => $form->createView(),

        ]);
    }

    /*public function _toString()
    {
        return $this->getTitle();
    } */


}