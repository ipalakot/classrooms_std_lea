<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Article;
use App\Entity\Commentaire;

use App\Form\CommentaireType;

use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PhpParser\Builder\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $article = $repo->find($id);

        $commentaire = $this->getDoctrine()
                      ->getRepository(Commentaire::class)
                      ->findBy(
                ['article'=> $article
                ]);

        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);

              $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
          //  $commentaire->setCreatedAt(new \DateTime());
            $manager->persist($commentaire); 
            $manager->flush();
        }

        return $this->render('blog/blog_show.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=> $article,
            'commentaire'=>$commentaire,
            'formCommentaire' => $form->createView(),

        ]);
    }

    public function _toString()
    {
        return $this->getTitle();
    } 


}