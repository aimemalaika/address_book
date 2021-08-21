<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Repository\ContactsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{
    public function __construct(ContactsRepository $repository)
    {
        $this->repository = $repository;
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
     * @Route("/contacts/{id}", name="contacts_single")
     */
    public function getOneContact($id): Response
    {
        $data = $this->repository->find($id);

        dump($data);

        return $this->render('contacts/single-contact.html.twig', [
            'controller_name' => 'ContactsController',
            'contact' => $data
        ]);
    }
    
}
