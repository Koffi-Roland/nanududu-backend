<?php

namespace App\Service\Nanududu;

use App\Entity\PersonneMorale;
use App\Service\Query\ValidationService;
use App\Service\Common\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Publication;
use App\Entity\PersonnePhysique;
use App\Entity\Souscription;
use App\Entity\Tag;
use App\Repository\PersonneMoraleRepository;
use App\Repository\PersonnePhysiqueRepository;
use App\Repository\SouscriptionRepository;
use Exception;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class PersonneMoraleService
{

    protected $em;
    private $validationService;
    private $messageService;

    private $personneMoraleRepository;



    public function __construct(MessageService $messageService,PersonneMoraleRepository $personneMoraleRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;

        $this->personneMoraleRepository = $personneMoraleRepository;
        $this->messageService=$messageService;

    }


    public function liste()
    {
        return $this->messageService->successRequest($this->personneMoraleRepository->findAll());

    }

    public function details(int $id)
    {
        return $this->messageService->successRequest($this->personneMoraleRepository->find($id));

    }

    public function ajouter(string $denomination, string $rccm, $adresse, bool $aggree)
    {
        //try{
        $personneMorale = new PersonneMorale();
        $personneMorale->setDenomination($denomination);
        $personneMorale->setRccm($rccm);
        $personneMorale->setAggree($aggree);
        $personneMorale->setAdresse($adresse);

        $this->em->persist($personneMorale);
        $this->em->flush();
        return $this->messageService->successRequest($personneMorale);

        //}catch(Exc){
        // return $this->messageService->execptionRequest($e);

        //}   

    }


    public function mettreAJour(int $id, string $denomination, string $rccm, $adresse)
    {
        $personneMorale = $this->personneMoraleRepository->find($id);
        if (!$personneMorale) {
            return null;
        }
        $personneMorale->setDenomination($denomination);
        $personneMorale->setRccm($rccm);
        $personneMorale->setAdresse($adresse);
       
        $this->em->flush();
        return $this->messageService->successRequest($personneMorale);

    }



    public function supprimer(int $id): void
    {
        $personneMorale = $this->personneMoraleRepository->find($id);
        if ($personneMorale) {
            $this->em->remove($personneMorale);
            $this->em->flush();
        }
    }
}
