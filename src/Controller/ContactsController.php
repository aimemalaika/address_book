<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Entity\ContactSearch;
use App\Form\ContactSearchType;
use App\Form\ContactsType;
use App\Repository\ContactsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function getAllContact(PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $search = new ContactSearch();
        $form = $this->createForm(ContactSearchType::class, $search);
        $form->handleRequest($request);


        $datas = $paginator->paginate(
            $this->repository->findAllMyContactsByName($search),
            $request->request->getInt('page',1),
            16
        );
        
        return $this->render('contacts/my-contact.html.twig', [
            'controller_name' => 'ContactsController',
            'searchform' => $form->createView(),
            'contacts' => $datas
        ]);
    }

    /**
     * @Route("/contacts/new", name="contacts_new")
     */
    public function createContact(Request $request): Response
    {
        $contact = new Contacts();
        $form = $this->createForm(ContactsType::class,$contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){    
            $this->manager->persist($contact);
            $this->manager->flush();
            $this->addFlash('success','Contact updated successfully');
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
    public function updateContact(Contacts $contact, Request $request): Response
    {
        $form = $this->createForm(ContactsType::class,$contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){    
            $contact->setCreatedAt($contact->getCreatedAt());
            $this->manager->persist($contact);
            $this->manager->flush();
            $this->addFlash('success','Contact updated successfully');
            return $this->redirectToRoute('contacts_single',['id'=>$contact->getId()]);
        }
        dump($contact->getEmails());
        return $this->render('contacts/edit-contact.html.twig', [
            'controller_name' => 'ContactsController',
            'contactform' => $form->createView(),
            'contact' => $contact
        ]);
    }

    /**
     * @Route("/contacts/{id}", name="contacts_single", requirements={"id"="\d+"})
     */
    public function getOneContact(Contacts $contact): Response
    {
        return $this->render('contacts/single-contact.html.twig', [
            'controller_name' => 'ContactsController',
            'contact' => $contact
        ]);
    }

    /**
     * @Route("/contacts/delete/{id}", name="contacts_delete", requirements={"id"="\d+"})
     */
    public function deleteContact(Contacts $contact, Request $request)
    {
        if($this->isCsrfTokenValid($contact->getId(),$request->request->get('_token'))){
            $this->manager->remove($contact);
            $this->manager->flush();
            $this->addFlash('success','Contact deleted successfully');
            return $this->redirectToRoute('contacts_list');
        }else{
            return $this->redirectToRoute('contacts_single',['id'=>$contact->getId()]);
        }            
    }

}
