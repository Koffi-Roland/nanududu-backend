<?php

namespace App\Service\Nanududu;

use App\Service\Query\ValidationService;
use App\Service\Common\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\PublicationRepository;
use App\Entity\Publication;
use App\Entity\PersonnePhysique;

use Exception;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class PublicationService
{

    protected $em;
    private $validationService;
    private $messageService;

    private $publicationRepository;



    public function __construct(MessageService $messageService,PublicationRepository $publicationRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;

        $this->publicationRepository = $publicationRepository;
        $this->messageService=$messageService;
    }


    public function liste()
    {
        return $this->messageService->successRequest($this->publicationRepository->findAll());
    }

    public function details(int $id)
    {
        return $this->messageService->successRequest($this->publicationRepository->find($id));

    }


    public function ajouter(string $libelle, string $description, \DateTimeInterface $date, \DateTimeInterface $expiration, PersonnePhysique $personne)
    {
        //try{
        $publication = new Publication();
        $publication->setLibelle($libelle);
        $publication->setDescription($description);
        $publication->setDate($date);
        $publication->setExpiration($expiration);
        $publication->setPersonnePhysique($personne);
        $this->em->persist($publication);
        $this->em->flush();
        return $this->messageService->successRequest($publication);
        //}catch(Exc){
        // return $this->messageService->execptionRequest($e);

        //}   

    }


    public function mettreAJour(int $id, string $libelle, string $description, \DateTimeInterface $date, \DateTimeInterface $expiration)
    {
        $publication = $this->publicationRepository->find($id);
        if (!$publication) {
            return null;
        }
        $publication->setLibelle($libelle);
        $publication->setDescription($description);
        $publication->setDate($date);
        $publication->setExpiration($expiration);
        $this->em->flush();
        return $this->messageService->successRequest($publication);
    }



    public function supprimer(int $id): void
    {
        $publication = $this->publicationRepository->find($id);
        if ($publication) {
           $this->em->remove($publication);
           $this->em->flush();
        }
    }
 

}
