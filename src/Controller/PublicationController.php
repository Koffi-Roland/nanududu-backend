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

}
