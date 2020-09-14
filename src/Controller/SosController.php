<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Repository\PublicationRepository;
use App\Service\Nanududu\PersonnePhysiqueService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use App\Service\Nanududu\SosService;
use App\Service\Nanududu\TagService;

/**
 * @Route("/api/sos")
 */
class SosController extends AbstractFOSRestController
{
     /**
     * @Rest\Get("/list")
     */
    public function liste(SOsService $sosService)
    {
        return  $sosService->liste();
       
    }


     /**
     * @Rest\Post("/ajout")
     */
    public function ajout(SOsService $sosService,PersonnePhysiqueService $personnePhysiqueService,TagService $tagService, Request $request)
    {
        return  $sosService->ajouter($personnePhysiqueService->detailsObject($request->get('personne')),$request->get('date'),$tagService->detailsObject($request->get('tag')),$request->get('etat'));
       
    }


}
