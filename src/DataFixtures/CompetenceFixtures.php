<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Niveau;
use App\Entity\Competence;
use App\Entity\Referentiel;
use App\Entity\GroupeDeCompetences;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompetenceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $competence= ["Créer une base de données", "Développer les composants d’accès aux données"];

        foreach ($competence as $competenceLibelle){

            $competence = new Competence();
            $competence->setLibelle($competenceLibelle)
                       ->setDescriptif("Pas d'informations")
                       ->setAchivage(false);

            for($i=1;$i<=3;$i++){
                $niveau = new Niveau();
                $niveau->setLibelle('Niveau '.$i)
                        ->setGroupeActions("Pas d'actions")
                        ->setCritereEvaluation("Pas de critères");
                        //->setArchivage(false);
                        $manager->persist($niveau);
                        $competence->addNiveau($niveau);
                    }
        
                    $manager->persist($competence);
        
                    $tab= ['Développer le back-end d’une application web', 'Développer le front-end d’une application web'];

            for($i=0; $i<2; $i++){

            $groupe= new GroupeDeCompetences();

            $groupe->setLibelle($tab[$i])
                   ->setDescriptif("Pas d'informations");
                   
                   $manager->persist($groupe);
                  $groupe->addCompetence($competence);
                 
            }


            $referentiel = new Referentiel();

            $referentiel->setLibelle("Developpement Web et mobile")
                        ->setPresentation("$faker->text")
                        ->setProgramme($faker->text)
                        ->setCritereEvaluation($faker->text)
                        ->setCritereAdmission($faker->text);

                        $manager->persist($referentiel);
                  $referentiel->addGroupesDeComptence($groupe);
    }
    $manager->flush();
}       

}
/*
        $tab= ['Développer le back-end d’une application web', 'Développer le front-end d’une application web'];

        for($i=0; $i<2; $i++){

            $groupe= new GroupeDeCompetences();

            $groupe->setLibelle($tab[$i])
                   ->setDescriptif("Pas d'informations");
                   //->addCompetences($competence);

                   $manager->persist($groupe);
        }
        $manager->flush();
    }
    */

    

  