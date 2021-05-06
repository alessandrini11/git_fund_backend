<?php

namespace App\DataFixtures;

use App\Entity\Adherent;
use App\Entity\Filiere;
use App\Entity\Poste;
use App\Entity\Sexe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 30; $i++){
            $adherent = new Adherent();
            for ($i = 0; $i < 2; $i++){
                $sexe = new Sexe();
                $sexe->setNom($faker->lastName);
                $manager->persist($sexe);
            }
            for ($j = 0; $j < 2; $j++){
                $filiere = new Filiere();
                $filiere->setNom($faker->lastName);
                $manager->persist($filiere);
            }
            for ($i = 0; $i < 5; $i++){
                $poste = new Poste();
                $poste->setNom($faker->lastName);
                $manager->persist($poste);
            }
            $adherent
                ->setNom($faker->name)
                ->setPrenom($faker->lastName)
                ->setSexe($sexe)
                ->setPoste($poste)
                ->setFiliere($filiere)
                ->setMatricule('20G0062'.$i)
                ->setMdp('password');
            $manager->persist($adherent);
        }

        $manager->flush();
    }
}
