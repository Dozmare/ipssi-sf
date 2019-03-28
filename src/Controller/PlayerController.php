<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Player;
use App\Repository\PlayerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(path="/player")
 */
class PlayerController extends AbstractController
{
    /**
     * @Route(path="/add-{username}")
     */
    public function add(string $username): Response
    {
        $player = new Player($username,
            rand(0,1000),
            rand(0,10),
            rand(0,10));
        $doctrine = $this->getDoctrine();
        $doctrine->getManager()->persist($player);
        $doctrine->getManager()->flush();

        $id = $player->getId();
        return new Response('L\'id est : '. $id);
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
}
