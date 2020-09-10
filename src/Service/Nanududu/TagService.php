<?php

namespace App\Service\Nanududu;

use App\Service\Query\ValidationService;
use App\Service\Common\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\TagRepository;
use App\Entity\Publication;
use App\Entity\PersonnePhysique;
use App\Entity\Tag;
use Exception;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class TagService
{

    protected $em;
    private $validationService;
    private $messageService;
    private $tagRepository;



    public function __construct(MessageService $messageService,TagRepository $tagRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->messageService=$messageService;
        $this->tagRepository = $tagRepository;
    }


    public function liste()
    {
        return $this->messageService->successRequest($this->tagRepository->findAll());
    }

    public function details(int $id)
    {
        return $this->messageService->successRequest($this->tagRepository->find($id));

    }


    public function ajouter(string $libelle, string $description)
    {
        //try{
        $tag = new Tag();
        $tag->setLibelle($libelle);
        $tag->setDescription($description);
        $this->em->persist($tag);
        $this->em->flush();
        return $this->messageService->successRequest($tag);
        //}catch(Exc){
        // return $this->messageService->execptionRequest($e);

        //}   

    }


    public function mettreAJour(int $id, string $libelle,string $description): ?Tag
    {
        $tag = $this->tagRepository->find($id);
        if (!$tag) {
            return null;
        }
        $tag->setLibelle($libelle);
        $tag->setDescription($description);
        $this->em->flush();
        return $this->messageService->successRequest($tag);
    }



    public function supprimer(int $id): void
    {
        $tag = $this->tagRepository->find($id);
        if ($tag) {
           $this->em->remove($tag);
           $this->em->flush();
        }
    }
 

}
