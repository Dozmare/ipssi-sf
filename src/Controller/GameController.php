<?php

declare(strict_types=1);


namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/game")
 */
class GameController extends AbstractController
{
    /**
     * @Route(path="/add")
     */
    public function add(Request $request): Response
    {
        $isOk = false;
        $newPartyForm = $this->createForm(GameType::class);
        $newPartyForm->handleRequest($request);
        if($newPartyForm->isSubmitted() && $newPartyForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newPartyForm->getData());
            $em->flush();
            $isOk = true;
        }

        return $this->render('game/add.html.twig', [
            'partyForm' => $newPartyForm->createView(),
            'isOk' => $isOk,
        ]);
    }

    /**
     * @Route(path="/edit/{id}")
     */
    public function edit(Request $request, Game $game): Response
    {
        $isOk = false;
        $newPartyForm = $this->createForm(GameType::class, $game);
        $newPartyForm->handleRequest($request);
        if($newPartyForm->isSubmitted() && $newPartyForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $isOk = true;
        }

        return $this->render('game/edit.html.twig', [
            'partyForm' => $newPartyForm->createView(),
            'isOk' => $isOk,
        ]);
    }

    /**
     * @Route(path="/delete/{id}")
     */
    public function delete(Game $game): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($game);
        $em->flush();
        
        return $this->redirectToRoute('app_game_list');
    }

    /**
     * @Route(path="/list")
     */
    public function list(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Game::class);

        return $this->render('game/list.html.twig', [
            'games' => $repository->findAll()
        ]);
    }


}
