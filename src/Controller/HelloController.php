<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends AbstractController
{
    public function sayHello(): Response
    {
        return $this->sayHelloTo('Ipssi');
    }

    public function sayHelloTo(string $name2): Response
    {
        return $this->render('Hello/say-hello.html.twig', [
            'name' => $name2
        ]);
    }
}

