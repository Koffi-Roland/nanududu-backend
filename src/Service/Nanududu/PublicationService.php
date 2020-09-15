<?php

namespace App\Service\Nanududu;

use App\Service\Query\ValidationService;
use App\Service\Common\MessageService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PublicationRepository;
use App\Entity\Publication;
use App\Entity\PersonnePhysique;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints\DateTime;

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
        return  $this->publicationRepository->findAll();
       // return $this->messageService->successRequest($this->publicationRepository->findAll());
    }

    public function publierParPersonne(PersonnePhysique $personne)
    {
        return $this->publicationRepository->findByUserPublication($personne);
       // return $this->messageService->successRequest($this->publicationRepository->findByUserPublication($personne));
    }

    public function dernierePublication()
    {

        return  $this->publicationRepository->findByLastPublication();
     // return $this->messageService->successRequest($this->publicationRepository->findByLastPublication());
    }

    public function details(int $id)
    {
        return $this->messageService->successRequest($this->publicationRepository->find($id));

    }

    public function detailsObject(int $id):?Publication
    {
        return $this->publicationRepository->find($id);

    }



    public function ajouter(string $libelle, string $description, string $date, string $expiration, PersonnePhysique $personne)
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


    public function mettreAJour(int $id, string $libelle, string $description, string $date, string $expiration)
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
