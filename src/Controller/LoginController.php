<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use App\Service\Common\MessageService;
use App\Service\Nanududu\LoginService;
use App\Service\Nanududu\PersonnePhysiqueService;
use Symfony\Component\HttpFoundation\Request;

class LoginController  extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/api/login")
     */
    public function login(LoginService $loginService,Request $request)
    {
        return $loginService->login($request->get('identifiant'),$request->get('motDePasse'));
    }
}
