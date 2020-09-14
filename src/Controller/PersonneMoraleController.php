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
use App\Service\Nanududu\PersonneMoraleService;

/**
 * @Route("/api/personnemorale")
 */
class PersonneMoraleController extends AbstractFOSRestController
{
     /**
     * @Rest\Get("/list")
     */
    public function liste(PersonneMoraleService $personneMoraleService)
    {
        return  $personneMoraleService->liste();
       
    }

}
