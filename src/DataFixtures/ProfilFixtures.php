<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilFixtures extends Fixture
{
  
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

   $tab= ['Admin', 'Formateur', 'Apprenant', 'CM'];

   for($p=0;$p<4;$p++){

    $profil = new Profil();

    $profil->setLibelle($tab[$p]);
    $this->addReference($tab[$p], $profil);
    $manager->persist($profil);

  
   }
   $manager->flush();
     
            
      
}

}