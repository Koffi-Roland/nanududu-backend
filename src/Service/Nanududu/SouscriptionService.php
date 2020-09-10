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
use App\Repository\SouscriptionRepository;
use Exception;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class SouscriptionService
{

    protected $em;
    private $validationService;
    private $messageService;

    private $souscriptionRepository;



    public function __construct(MessageService $messageService,SouscriptionRepository $souscriptionRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->messageService=$messageService;

        $this->souscriptionRepository = $souscriptionRepository;
    }


    public function liste()
    {

       return $this->messageService->successRequest($this->souscriptionRepository->findAll());
    }

    public function details(int $id)
    {
      return  $this->messageService->successRequest($this->souscriptionRepository->find($id));

    }


    public function souscrire(PersonnePhysique $personnePhysique,\DateTimeInterface $date, Publication $publication , bool $etat)
    {
        //try{
        $souscription = new Souscription();
        $souscription->setDate($date);
        $souscription->setEtat($etat);
        $souscription->setPersonnePhysique($personnePhysique);
        $souscription->setPublication($publication);
       
        $this->em->persist($souscription);
        $this->em->flush();
        return  $this->messageService->successRequest($souscription);

        //}catch(Exc){
        // return $this->messageService->execptionRequest($e);

        //}   

    }


    public function mettreAJourEtat(int $id,bool $etat)
    {
        $souscription = $this->souscriptionRepository->find($id);
        if (!$souscription) {
            return null;
        }
        $souscription->setEtat($etat);
      
        $this->em->flush();
        return  $this->messageService->successRequest($souscription);
    }



    public function supprimer(int $id): void
    {
        $souscription = $this->souscriptionRepository->find($id);
        if ($souscription) {
           $this->em->remove($souscription);
           $this->em->flush();
        }
    }
 

}
