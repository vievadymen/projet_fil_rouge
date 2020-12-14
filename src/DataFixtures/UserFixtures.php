<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\DataFixtures\ProfilFixtures;
use App\Entity\CM;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USER_REFERENCE = 'user';

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

    for($i=0; $i<16; $i++){
        if($i<4){
            $user = new User();
            $user->setProfil($this->getReference("Admin"));

        }
        elseif($i<8){
            $user = new Formateur();
            $user->setProfil($this->getReference("Formateur"));

        }
        elseif($i<12){
            $user = new Apprenant();
            $user->setProfil($this->getReference("Apprenant"));

        }
        else{
            $user = new CM();
            $user->setProfil($this->getReference("CM"));

        }

       
        
        $password = $this->encoder->encodePassword($user, 'pass');
        
            $user->setNom($faker->lastName)
                 ->setPrenom($faker->firstName)
                 ->setUsername($faker->userName)
                 ->setGenre($faker->randomElement(["Femme","Homme"]))
                 ->setPassword($password)
                 ->setEmail($faker->email)
                 ->setTel($faker->phoneNumber)
                 ->setPhoto($faker->imageUrl(300,300));
              

            $manager->persist($user);
           
       
    }

    $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
        );
    }
}
