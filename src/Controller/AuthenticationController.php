<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/login", name="authentication_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationutils): Response
    {
        $getUsername = $authenticationutils->getLastUsername();
        $errors =  $authenticationutils->getLastAuthenticationError();

        return $this->render('authentication/login.html.twig', [
            'controller_name' => 'AuthenticationController',
            'lastusername' => $getUsername,
            'errors' => $errors
        ]);
    }

    /**
     * @Route("/register", name="authentication_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $this->manager->persist($user);
            $this->manager->flush();
            $this->addFlash('success','Account Create successfully');
            return $this->redirectToRoute('authentication_login');
        }

        return $this->render('authentication/register.html.twig', [
            'controller_name' => 'AuthenticationController',
            'registrationform' => $form->createView()
        ]);
    }
    /**
     * @Route("/logout", name="authentication_logout")
     */
    
    public function logout(){}
}
