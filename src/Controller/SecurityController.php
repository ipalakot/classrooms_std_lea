<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
     /**
    * @Route("enregistrement", name="enregistrement")
    * 
    */
    public function formUser(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        
        $form = $this->createFormBuilder($user)
                     ->add('email')
                     ->add('password', PasswordType::class)

                     ->getForm();
                     
                $form->handleRequest($request);
               
                if($form->isSubmitted() && $form->isValid()) {
                    $hash = $encoder->encodePassword($user, $user->getPassword());

                    $user->setPassword($hash);
                    
                    $manager->persist($user);
                    $manager->flush();
                    //$this->addFlash('success', 'Votre compte à bien été enregistré.');
                        return $this->redirectToRoute('login');
                }

        return $this->render('security/enregistrement.html.twig', [
            'controller_name' => 'SecurityController',
            'formUser' => $form->createView()
        ]);
    }


    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout() { 
        //ToDo
    }
    
}
