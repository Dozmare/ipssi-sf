<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Player;

use App\Form\PlayerInscriptionType;

use App\Repository\PlayerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(path="/player")
 */
class PlayerController extends AbstractController
{
    /**
     * @Route(path="/add")
     */
    public function add(Request $request): Response
    {
        $form = $this->createForm(PlayerInscriptionType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $player = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirectToRoute('app_player_view', [
                'id' => $player->getId(),
            ]);
        }


        return $this->render('player/add.html.twig', [
            'PlayerInscriptionForm' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/list")
     */
    public function list(): Response
    {
        $doctrine = $this->getDoctrine();

        /** @var PlayerRepository $repository */
        $repository = $doctrine->getRepository(Player::class);

        $players = $repository->findAll();
        $listGain = $repository->getTop5Amount();
        $listGain = $repository->findBy([], ['amount' => 'DESC'], 5);
        $listRatio = $repository->getTopRatio();

        return $this->render("player/list.html.twig", [
            'players' => $players,
            'listTop5Amount' => $listGain,
            'listRatio' => $listRatio
        ]);
    }

    /**
     * @Route(path="/view/{id}")
     */
    public function viewShort(Player $player): Response
    {
        return $this->render('player/view.html.twig', [
            'player' => $player
        ]);
    }
    /**
     * @Route(path="/view/{id}")
     */
    public function view(int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Player::class);
        $player = $repository->find($id);

        if($player === null) {
            throw $this->createNotFoundException();
        }
        return $this->render('player/view.html.twig', [
            'player' => $player
        ]);
    }
}
