<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\PartyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/party")
 */
class PartyController extends AbstractController
{
    /**
     * @Route(path="/add")
     */
    public function add(Request $request): Response
    {
        $isOk = false;
        $newPartyForm = $this->createForm(PartyType::class);
        $newPartyForm->handleRequest($request);
        if($newPartyForm->isSubmitted() && $newPartyForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newPartyForm->getData());
            $em->flush();
            $isOk = true;
        }

        return $this->render('party/add.html.twig', [
            'partyForm' => $newPartyForm->createView(),
            'isOk' => $isOk,
        ]);
    }
}
