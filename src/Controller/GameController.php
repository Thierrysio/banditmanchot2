<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SlotMachine;
class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(): Response
    {
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }
    #[Route('/game/play/{id}', name: 'game_play')]
    public function play(SlotMachine $slotMachine,EntityManagerInterface $Manager) { // Supposons que $joueur est automatiquement injecté (par ex. en utilisant un voter ou autre mécanisme d'authentification)
        $results = $slotMachine->jouer();
        $message = $slotMachine->calculerGain($results);
//dd($results,$message);
        // Si le joueur gagne, augmentez son solde, sinon déduisez une somme fixe pour le coût du jeu
        // Sauvegardez ensuite le joueur mis à jour dans la base de données

        return $this->render('game/play.html.twig', [
            'results' => $results,
            'message' => $message
        ]);
    }
}
