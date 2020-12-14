<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\Profil;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

/**
 *
 */
class Archivage implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this-> entityManager = $entityManager;
    }


    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Profil;
    }

    /**
     * @param Profil $data
     */
    public function persist($data, array $context = [])
    {
        //$this->entityManager->persist($data);
        //$this->entityManager->flush();
        return $data;
    }

    public function remove($data, array $context = [])
    {
        $data->setArchivage(true);
        //$this->entityManager->persist($data);
       // $archive=$data->setArchivage(true);
       $Users=$data->getUser();
        foreach($data as $User) {
          $arhcivageUser=$data->setArchivage(true);
        }
        $this->entityManager->flush();
    }
}