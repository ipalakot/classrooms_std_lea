<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
    * @Route("/", name="accueil2")
    * @Route("/accueil", name="accueil")
    */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles =  $paginator->paginate(
            $repo->findAll(), 
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles'=> $articles
        ]);
    }   

    /**
    * @Route("/apropos", name="apropos")
    */
    public function a_propos()
    {
        return $this->render('home/a_propos.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    /**
    * @Route("/articles", name="articles")
    */
    public function articles()
    {
        return $this->render('home/les_articles.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }  

    /**
    * @Route("/contact", name="contact")
    */
    public function contact()
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
            'age' => '21',
         ]);
    }  

    /**
    * @Route("/admin/admin", name="admin")
    */
    public function admin()
    {
        return $this->render('home/admin.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    } 

}

