<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyFormType;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
    /**
     *
     * @var PropertyRepository
     */
    private $repository;

    private $entityManager;

    public function __construct(PropertyRepository $repository, ManagerRegistry $em)
    {

        $this->repository = $repository;
        $this->entityManager = $em->getManager();

    }

    /**
     *@Route("/admin", name="admin.property.index")
     * @return Response
     */
    public function index()
    {
        //Je veux récupérer tous mes biens
        $properties = $this->repository->findAll(); 
        //compact va me permettre d'nvoyer un tableau
        return $this->render('admin/property/index.html.twig', compact('properties')); 
    }

    /**
     * @Route("/admin/property/create", name="admin.property.new")
     */
    public function new(Request $request) //function qui nous permet creer un nouveau bien
    {
        // Entité crée de façon manuelle donc non suivi par l'EntityManager (permet de faire le lien entre ma BDD et mes entités)
        $property = new Property();

        $form = $this->createForm(PropertyFormType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // avant de flush nous voulons suivre cette nouvelle propriété grace à l'entitymanager qui sera en mesure de faire les changement
            $this->entityManager->persist($property);
            $this->entityManager->flush();
            $this->addFlash('success', 'bien créé avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/new.html.twig',[
            'property' => $property,// les propriétes
            'form'     => $form->createView()//le Form
        ]);
    }

    //function qui nous permet d'editer un nouveau bien
    /**
     *@Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function edit(Property $property, Request $request)
    {
        // la variable $property contien nos données (tab ou entité) ici ce sont nos entité qui ont toutes les informations necessaires pour remplir le formulaire
        $form = $this->createForm(PropertyFormType::class, $property);
        // nous demandons à notre formulaire 
        $form->handleRequest($request);
        // est ce que le Form a été envoyé   est ce qui est valide
        if($form->isSubmitted() && $form->isValid())
        {
            // apporter les infos au niveau de la BDD
            $this->entityManager->flush();
            $this->addFlash('success', 'bien modifié avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            // envoie du $form avec l'object createView à notre template via la variable form
            'form' => $form->createView()
        ]);
    } 
    
    /**
     * @Route("/admin/property/delete/{id}", name="admin.property.delete", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function delete(Property $property, Request $request)
    {
        // On verifie si notre Token généré automatiquement est valide
        if($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token')))
        {
        $this->entityManager->remove($property);
        $this->entityManager->flush();
        $this->addFlash('success', 'Bien supprimé avec succés');
        }
        return $this->redirectToRoute('admin.property.index'); 
    }
}