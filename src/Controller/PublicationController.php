<?php

namespace App\Controller;

use App\Entity\PersonnePhysique;
use App\Entity\Publication;
use App\Repository\PublicationRepository;
use App\Service\Nanududu\PersonnePhysiqueService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use App\Service\Nanududu\PublicationService;

/**
 * @Route("/publication")
 */
class PublicationController extends AbstractFOSRestController
{
     /**
     * @Rest\Get("/list")
     */
    public function liste(PublicationService $publicationService)
    {
        return  $publicationService->liste();
       
    }

      /**
     * @Rest\Get("/list/derniere")
     */
    public function dernierePublication(PublicationService $publicationService)
    {
        return  $publicationService->dernierePublication();
       
    }


      /**
     * @Rest\Post("/ajout")
     */
    public function ajouter(PublicationService $publicationService,PersonnePhysiqueService $personnePhysiqueService,Request $request)

    {
        return  $publicationService->ajouter($request->get('libelle'),$request->get('description'),$request->get('date'),$request->get('expiration'),$personnePhysiqueService->detailsObject($request->get('personne')));

       
    }


     /**
     * @Rest\Put("/update/{id}")
     */
    public function mettreAJour(PublicationService $publicationService,PersonnePhysiqueService $personnePhysiqueService,Request $request)

    {
        
        return  $publicationService->mettreAJour($request->get('id'),$request->get('libelle'),$request->get('description'),$request->get('date'),$request->get('expiration'));
          
    }







}
