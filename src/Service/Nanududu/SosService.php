<?php

namespace App\Service\Nanududu;

use App\Service\Query\ValidationService;
use App\Service\Common\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Publication;
use App\Entity\PersonnePhysique;
use App\Entity\Sos;
use App\Entity\Souscription;
use App\Entity\Tag;
use App\Repository\SosRepository;
use App\Repository\SouscriptionRepository;
use Exception;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class SosService
{

    protected $em;
    private $validationService;
    private $messageService;
    private $sosRepository;



    public function __construct(MessageService $messageService,SosRepository $sosRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->messageService=$messageService;
        $this->sosRepository = $sosRepository;
    }


    public function liste()
    {
      return  $this->messageService->successRequest($this->sosRepository->findAll());
    }

    public function details(int $id)
    {
    return $this->messageService->successRequest($this->sosRepository->find($id));
    }


    public function ajouter(PersonnePhysique $personnePhysique,\DateTimeInterface $date, Tag $tag , bool $etat)
    {
        //try{
        $sos = new Sos();
        $sos->setDate($date);
        $sos->setEtat($etat);
        $sos->setPersonnePhysique($personnePhysique);
        $sos->addTag($tag);
        $this->em->persist($sos);
        $this->em->flush();
        return $this->messageService->successRequest($sos);

        //}catch(Exc){
        // return $this->messageService->execptionRequest($e);

        //}   

    }


    public function mettreAJourEtat(int $id,bool $etat)
    {
        $sos = $this->souscriptionRepository->find($id);
        if (!$sos) {
            return null;
        }
        $sos->setEtat($etat);
        $this->em->flush();
        return $this->messageService->successRequest($sos);
    }



    public function supprimer(int $id): void
    {
        $sos = $this->sosRepository->find($id);
        if ($sos) {
           $this->em->remove($sos);
           $this->em->flush();
        }
    }
 

}
