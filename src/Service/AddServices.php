<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\Repository\UserRepository;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AddServices 
{
    private $manager,
            $serializer, 
            $validator,
            $repo, 
            $encoder,
            $profilRepository;
    public function __construct(UserPasswordEncoderInterface $encoder,UserRepository $repo,
        EntityManagerInterface $manager,SerializerInterface $serializer, ValidatorInterface $validator,ProfilRepository $profilRepository)
        {
            $this->serializer = $serializer;
            $this->UserRepository = $repo;
            $this->manager = $manager;
            $this->validator = $validator;
            $this->encoder = $encoder;
            $this->profilRepository = $profilRepository;
        }
        public function addUser(Request $request){
            $user = $request->request->all();
           
            $profil=$this->profilRepository->find($user['profils']);
          
            if($profil->getLibelle() === "Admin"){ 
                $userTab = $this->serializer->denormalize($user, Admin::class, "json");
            }
            if($profil->getLibelle() === "Formateur"){
                $userTab = $this->serializer->denormalize($user, Formateur::class, "json");
            }
            if($profil->getLibelle() === "Apprenant"){
                $userTab =$this->serializer->denormalize($user, Apprenant::class, "json");
            }
        
            $userTab->setProfil($profil);
            $password = $userTab->getPassword();
            $userTab->setPassword($this->encoder->encodePassword($userTab, $password));
            $avatar = $request->files->get("photo");
            $avatar = fopen($avatar->getRealPath(),"rb");
            $userTab->setPhoto($avatar);
           //dd($userTab);
        
             $this->manager->persist($userTab);
             $this->manager->flush();
             fclose($avatar);
             return $userTab;
        }

}