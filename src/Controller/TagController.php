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
use App\Service\Nanududu\TagService;

/**
 * @Route("/tag")
 */
class TagController extends AbstractFOSRestController
{
     /**
     * @Rest\Get("/list")
     */
    public function liste(TagService $tagService)
    {
        return  $tagService->liste();
       
    }

        /**
     * @Rest\Post("/ajout")
     */
    public function ajout(TagService $tagService,Request $request)
    {
        return  $tagService->ajouter($request->get('libelle'),$request->get('description'));
       
    }

}
