<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        [
            'number' => '1',
            'year' => '2010',
            'description' => "La population entière a été ravagée par une épidémie d'origine inconnue, qui est envahie 
            par les morts-vivants. Parti sur les traces de sa femme Lori et de son fils Carl, Rick arrive à Atlanta où, 
            avec un groupe de rescapés, il va devoir apprendre à survivre et à tuer tout en cherchant une solution ou 
            un remède.",
            'program' => 'program_Walking Dead',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $key => $seasons) {
            $season = new Season();
            $season->setNumber($seasons['number']);
            $season->setYear($seasons['year']);
            $season->setDescription($seasons['description']);
            $season->setProgram($this->getReference($seasons['program']));
            $manager->persist($season);
            $this->addReference('season' . $seasons['number'] . "_" . str_replace('program_', '', $seasons['program']), $season);
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
