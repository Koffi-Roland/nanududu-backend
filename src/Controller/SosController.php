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
use App\Service\Nanududu\SosService;

/**
 * @Route("/sos")
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

}
