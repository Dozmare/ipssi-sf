<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function sayHello(): Response
    {
        return $this->sayHelloTo('Ipssi');
    }

    public function sayHelloTo(string $name2): Response
    {
        return new Response('bonjour ' . $name2);
    }
}

