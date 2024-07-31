<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'Walking Dead',
            'synopsis' => 'Des zombies envahissent la terre.',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Die Hard',
            'synopsis' => 'Un policier doit sauver des otages dans un gratte-ciel.',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Mad Max',
            'synopsis' => 'Dans un futur post-apocalyptique, un guerrier solitaire cherche la justice.',
            'category' => 'category_Action',
        ],
        [
            'title' => 'John Wick',
            'synopsis' => 'Un ancien tueur à gages reprend du service pour venger la mort de son chien.',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Terminator',
            'synopsis' => 'Un cyborg tueur est envoyé dans le passé pour tuer la mère du futur chef de la résistance.',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Indiana Jones',
            'synopsis' => 'Un archéologue aventurier parcourt le monde à la recherche de trésors perdus.',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Le Seigneur des Anneaux',
            'synopsis' => 'Un hobbit doit détruire un anneau maléfique pour sauver le monde.',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Pirates des Caraïbes',
            'synopsis' => 'Les aventures d\'un capitaine pirate et de son équipage.',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Jurassic Park',
            'synopsis' => 'Un parc d\'attractions avec des dinosaures clonés devient hors de contrôle.',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Harry Potter',
            'synopsis' => 'Un jeune sorcier découvre ses pouvoirs et affronte les forces du mal.',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Toy Story',
            'synopsis' => 'Les jouets prennent vie et vivent des aventures.',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Le Roi Lion',
            'synopsis' => 'Un jeune lion doit reprendre son trône après la mort de son père.',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Shrek',
            'synopsis' => 'Un ogre part en mission pour sauver une princesse.',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'La Reine des Neiges',
            'synopsis' => 'Deux sœurs doivent sauver leur royaume de l\'hiver éternel.',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Les Indestructibles',
            'synopsis' => 'Une famille de super-héros doit sauver le monde.',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Game of Thrones',
            'synopsis' => 'Les familles nobles s\'affrontent pour le trône de fer dans un monde médiéval fantastique.',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Le Hobbit',
            'synopsis' => 'Un hobbit part en quête pour aider des nains à récupérer leur montagne.',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Narnia',
            'synopsis' => 'Des enfants découvrent un monde magique à travers une armoire.',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Doctor Strange',
            'synopsis' => 'Un chirurgien découvre des arts mystiques après un accident qui change sa vie.',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Alice au Pays des Merveilles',
            'synopsis' => 'Une jeune fille découvre un monde fantastique en suivant un lapin blanc.',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'The Conjuring',
            'synopsis' => 'Des enquêteurs paranormaux aident une famille hantée par un esprit maléfique.',
            'category' => 'category_Horreur',
        ],
        [
            'title' => 'It',
            'synopsis' => 'Un groupe d\'enfants affrontent un clown maléfique qui terrorise leur ville.',
            'category' => 'category_Horreur',
        ],
        [
            'title' => 'Halloween',
            'synopsis' => 'Un tueur en série échappé de l\'asile retourne dans sa ville natale.',
            'category' => 'category_Horreur',
        ],
        [
            'title' => 'The Ring',
            'synopsis' => 'Une journaliste enquête sur une mystérieuse cassette vidéo qui tue ceux qui la regardent.',
            'category' => 'category_Horreur',
        ],
        [
            'title' => 'A Quiet Place',
            'synopsis' => 'Une famille doit vivre en silence pour échapper à des créatures sensibles au bruit.',
            'category' => 'category_Horreur',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $programs) {
            $program = new Program();
            $program->setTitle($programs['title']);
            $program->setSynopsis($programs['synopsis']);
            $program->setCategory($this->getReference($programs['category']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
