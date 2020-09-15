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

class PersonnePhysiqueService
{

    protected $em;
    private $validationService;
    private $messageService;

    private $personnePhysiqueRepository;



    public function __construct(MessageService $messageService,PersonnePhysiqueRepository $personnePhysiqueRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->messageService=$messageService;

        $this->personnePhysiqueRepository = $personnePhysiqueRepository;
    }


    public function liste()
    {

       return $this->personnePhysiqueRepository->findAll();
      //  return $this->messageService->successRequest($this->personnePhysiqueRepository->findAll());
    }

    public function details(int $id)
    {
        return $this->messageService->successRequest( $this->personnePhysiqueRepository->find($id));

    }

    public function detailsObject(int $id):?PersonnePhysique
    {
        return  $this->personnePhysiqueRepository->find($id);

    }

    public function detailsObjectByTelephone(string $telephone):?PersonnePhysique
    {
        return $this->personnePhysiqueRepository->findOneByTelephone($telephone);

    }
    public function ajouter(string $nom, string $prenom,string $identifiant, string $motDePasse, $telephone ,/* string $ville,*/  string $adresse , bool $aggree,array $roles)
    {
        //try{
            $personnePhysique = new PersonnePhysique();
           // $personnePhysique->setVille($ville);
            $personnePhysique->setNom($nom);
            $personnePhysique->setPrenom($prenom);
            $personnePhysique->setTelephone($telephone);
            $personnePhysique->setIdentifiant($identifiant);
            $personnePhysique->setPassword(password_hash($motDePasse, PASSWORD_BCRYPT));
            $personnePhysique->setRoles($roles);
            $personnePhysique->setAggree($aggree);
            $personnePhysique->setAdresse($adresse);
       
        $this->em->persist($personnePhysique);
        $this->em->flush();


        return $this->messageService->successRequest($personnePhysique);
        //}catch(Exc){
        // return $this->messageService->execptionRequest($e);

        //}   

    }


    public function mettreAJour(int $id,string $ville,string $nom,string $prenom,string $identifiant,string $telephone)
    {
        $personnePhysique = $this->personnePhysiqueRepository->find($id);
        if (!$personnePhysique) {
            return null;
        }
        $personnePhysique->setVille($ville);
        $personnePhysique->setNom($nom);
        $personnePhysique->setIdentifiant($identifiant);
        $personnePhysique->setTelephone($telephone);
        $this->em->flush();
        return $this->messageService->successRequest($personnePhysique);

    }



    public function supprimer(int $id): void
    {
        $personnePhysique = $this->personnePhysiqueRepository->find($id);
        if ($personnePhysique) {
           $this->em->remove($personnePhysique);
           $this->em->flush();
        }
    }


    public function modiferMotDePasse(int $id,string $ancienMotPasse,string $nouveauMotDePasse)
    {
        $personnePhysique = $this->personnePhysiqueRepository->find($id);
       
        if(password_verify($ancienMotPasse,$personnePhysique->getPassword())){
            $personnePhysique->setMotDePasse($nouveauMotDePasse);
            $this->em->persist($personnePhysique);
            $this->em->flush();
            return $this->messageService->successRequest(true);

        }
        return $this->messageService->successRequest(false);

       // return false;
        
    }
 

}
