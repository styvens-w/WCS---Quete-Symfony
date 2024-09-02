<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Boucle pour chaque série
        for ($i = 1; $i <= 10; $i++) {
            // Boucle pour chaque saison dans la série
            for ($j = 1; $j <= 5; $j++) {
                // Créer 10 épisodes pour chaque saison
                for ($k = 1; $k <= 10; $k++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->sentence(3));
                    $episode->setNumber($k);
                    $episode->setSynopsis($faker->paragraph());
                    $episode->setSeason($this->getReference('season' . $i . '_' . $j));

                    $manager->persist($episode);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
