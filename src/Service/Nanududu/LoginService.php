<?php

namespace App\Service\Nanududu;

use App\Service\Query\ValidationService;
use App\Service\Common\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Publication;
use App\Entity\PersonnePhysique;
use App\Entity\Souscription;
use App\Entity\Tag;
use App\Repository\PersonnePhysiqueRepository;
use App\Repository\SouscriptionRepository;
use Exception;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class LoginService
{

    protected $em;
    private $validationService;

    private $personnePhysiqueRepository;
    private $messageService;



    public function __construct(MessageService $messageService,PersonnePhysiqueRepository $personnePhysiqueRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->messageService=$messageService;

        $this->personnePhysiqueRepository = $personnePhysiqueRepository;
    }


   public function login(string $identifiant,string $motDePasse)
   {


    $personnePhysique=  $this->personnePhysiqueRepository->findOneByIdentifiant($identifiant); 
    if(password_verify($motDePasse,$personnePhysique->getPassword())){
       return $this->messageService->successRequest($personnePhysique);
    }
    else return ;
   }
 

}
