<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function Connexion()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityCotrollerController',
        ]);
    }

    /**
    * @Route("/deconnexion", name="deconnexion")
    */
    public function Deconnexion()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityCotrollerController',
        ]);
    }

    /**
    * @Route("/enregistrement", name="enregistrement")
    */
    public function Enregistrement(Request $request, ObjectManager $manager)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($user); 
            $manager->flush();
        }

        return $this->render('security/index.html.twig', [
            'formCreatUser' => $form->createView(),
        ]);
    }

    /**
    * @Route("/modification", name="modification")
    */
    public function Modification(User $user, Request $request, ObjectManager $manager)
    {
        $form = $this->createFormBuilder($user)
        ->add('Nom')
        ->add('Login')
        ->add('email')
        ->add('password')
        ->getForm();

        $form->handleRequest($request);
            
        if($form->isSubmitted() && $form->isValid())
            {
                $manager->persist($user); 
                $manager->flush();
            }

        return $this->render('security/index.html.twig', [
            'formCreatUser' => $form->createView(),
        ]);
    }

}
