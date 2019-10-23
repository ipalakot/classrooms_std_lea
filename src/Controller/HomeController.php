<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
    * @Route("/", name="accueil2")
    * @Route("/accueil", name="accueil")
    */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
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
    * @Route("/admin", name="admin")
    */
    public function admin()
    {
        return $this->render('home/admin.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    } 

}

