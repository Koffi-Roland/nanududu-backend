<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Repository\PublicationRepository;
use App\Service\Nanududu\PersonnePhysiqueService;
use App\Service\Nanududu\PublicationService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use App\Service\Nanududu\SouscriptionService;

/**
 * @Route("/api/souscription")
 */
class SouscriptionController extends AbstractFOSRestController
{
     /**
     * @Rest\Get("/list")
     */
    public function liste(SOuscriptionService $souscriptionService)
    {
        return  $souscriptionService->liste();
       
    }

     /**
     * @Rest\Post("/ajout")
     */
    public function souscrire(PersonnePhysiqueService $personnePhysiqueService, SOuscriptionService $souscriptionService,PublicationService $publicationService,Request $request)
    {
        return  $souscriptionService->souscrire($personnePhysiqueService->detailsObject($request->get('personne')),$request->get('date'),$publicationService->detailsObject($request->get('publication')),$request->get('etat'));
       
    }

}
