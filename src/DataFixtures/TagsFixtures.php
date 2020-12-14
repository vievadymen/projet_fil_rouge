<?php

namespace App\DataFixtures;

use App\Entity\Tags;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $tagTable = ['PHP', 'JS', 'HTML5', 'SQL', 'CSS3', 'JQUERY', 'SYMFONY', 'ApiPlatform'];

        foreach ($tagTable as $tagLibelle) {
            $tag = new Tags();
            $tag->setLibelle($tagLibelle)
                ->setDescriptif("Pas d'informations")
                ->setArchivage(false);

            $manager->persist($tag);
            
            
        }

        $manager->flush();


    }
}
