<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Repository\PublicationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use App\Service\Nanududu\PersonnePhysiqueService;

/**
 * @Route("/personnephysique")
 */
class PersonnePhysiqueController extends AbstractFOSRestController
{
     /**
     * @Rest\Get("/list")
     */
    public function liste(PersonnePhysiqueService $personnePhysiqueService)
    {
        return  $personnePhysiqueService->liste();
       
    }

       /**
     * @Rest\Post("/ajout")
     */
    public function ajouter(PersonnePhysiqueService $personnePhysiqueService,Request $request)
    {

        return  $personnePhysiqueService->ajouter($request->get('nom'),$request->get('prenom'),$request->get('identifiant'),$request->get('motDePasse'),$request->get('telephone'),$request->get('ville'),$request->get('adresse'),$request->get('aggree'),$request->get('roles'));
       
    }

}
