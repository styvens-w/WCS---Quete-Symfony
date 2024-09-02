<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Boucle pour chaque série
        for ($i = 1; $i <= 10; $i++) {
            // Créer 5 saisons pour chaque série
            for ($j = 1; $j <= 5; $j++) {
                $season = new Season();
                $season->setNumber($j);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraph());
                $season->setProgram($this->getReference('program_' . $i));

                $manager->persist($season);

                // Créer une référence pour chaque saison
                $this->addReference('season' . $i . '_' . $j, $season);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
