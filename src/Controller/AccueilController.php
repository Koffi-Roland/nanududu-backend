<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use App\Service\Common\MessageService;

class AccueilController  extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/home")
     */
    public function home(MessageService $messageService)
    {

        $data['message'] = 'Bienvenue sur la plateforme nanududu!';
        $data['version'] = '1.0';

        return $messageService->successRequest($data);
    }
}
