<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    // Correspond à la route /program/ et au name "program_index"
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    // Correspond à la route /program/{id} et au name "program_show"
    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);

        if (!$program) {
                throw $this->createNotFoundException('No program with id : '.$id.' found in program\'s table.');
            }

        return $this->render('program/show.html.twig', [
            'program' => $program
        ]);
    }

    // Correspond à la route /program/seasons/{seasonId} et au name "season_show"
    #[Route('/{programId}/seasons/{seasonId}', name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->find($programId);

        if (!$program) {
            throw $this->createNotFoundException('No program with id : ' . $programId . ' found in program\'s table.');
        }

        $season = $seasonRepository->findOneBy([
            'id' => $seasonId,
            'program' => $programId
        ]);

        if (!$season) {
            throw $this->createNotFoundException('No season with id : ' . $seasonId . ' found for program with id : ' . $programId);
        }

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season
        ]);
    }
}