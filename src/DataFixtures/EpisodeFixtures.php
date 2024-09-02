<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'title' => 'Passé décomposé',
            'number' => '1',
            'synopsis' => "Rick Grimes, shérif, est blessé à la suite d'une course-poursuite. Il se retrouve dans le 
            coma. Cependant, lorsqu'il se réveille dans l'hôpital, il ne découvre que désolation et cadavres",
            'season' => 'season1_Walking Dead',
        ],
        [
            'title' => 'Tripes',
            'number' => '2',
            'synopsis' => "Rick parvient à s'échapper du tank grâce à l'aide de Glenn, dont il avait entendu la voix à 
            la radio. Rick et Glenn se réunissent avec les compagnons de Glenn, un autre groupe de survivants dont 
            Andrea, T-dog, Merle, Morales, Jacqui, venus pour se ravitailler au supermarché.",
            'season' => 'season1_Walking Dead',
        ],
        [
            'title' => 'T\'as qu\'à discuter avec les grenouilles',
            'number' => '3',
            'synopsis' => "De retour au camp avec le groupe de survivants du supermarché, Rick retrouve enfin et avec 
            beaucoup d'émotion sa femme Lori et son fils Carl. Andrea quant à elle, rejoint sa jeune sœur Amy.",
            'season' => 'season1_Walking Dead',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $episodes) {
            $episode = new Episode();
            $episode->setTitle($episodes['title']);
            $episode->setNumber($episodes['number']);
            $episode->setSynopsis($episodes['synopsis']);
            $episode->setSeason($this->getReference($episodes['season']));
            $manager->persist($episode);
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
