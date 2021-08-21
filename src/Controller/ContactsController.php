<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Repository\ContactsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{
    public function __construct(ContactsRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }
    /**
     * @Route("/", name="contacts_list")
     */
    public function getAllContact(): Response
    {
        $datas = $this->repository->findAll();
        
        return $this->render('contacts/my-contact.html.twig', [
            'controller_name' => 'ContactsController',
            'contacts' => $datas
        ]);
    }

    /**
     * @Route("/contacts/new", name="contacts_new")
     */
    public function createContact(Request $request): Response
    {

        $contact = new Contacts();

        $form = $this->createFormBuilder($contact)
                        ->add('firstname')
                        ->add('lastname')
                        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){    
            $this->manager->persist($contact);
            $this->manager->flush();
            return $this->redirectToRoute('contacts_single',['id'=>$contact->getId()]);
        }

        return $this->render('contacts/new-contact.html.twig', [
            'controller_name' => 'ContactsController',
            'contactform' => $form->createView()
        ]);
    }

    /**
     * @Route("/contacts/edit/{id}", name="contacts_edit", requirements={"id"="\d+"})
     */
    public function updateContact(Request $request): Response
    {

        $contact = new Contacts();

        $form = $this->createFormBuilder($contact)
                        ->add('firstname')
                        ->add('lastname')
                        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){    
            $this->manager->persist($contact);
            $this->manager->flush();
            return $this->redirectToRoute('contacts_single',['id'=>$contact->getId()]);
        }

        return $this->render('contacts/edit-contact.html.twig', [
            'controller_name' => 'ContactsController',
            'contactform' => $form->createView()
        ]);
    }

    /**
     * @Route("/contacts/{id}", name="contacts_single", requirements={"id"="\d+"})
     */
    public function getOneContact($id): Response
    {
        $data = $this->repository->find($id);

        return $this->render('contacts/single-contact.html.twig', [
            'controller_name' => 'ContactsController',
            'contact' => $data
        ]);
    }

}
