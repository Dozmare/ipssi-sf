<?php

declare(strict_types=1);


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class RandomController
{

    public function getResult(int $nb, int $min, int $max):Response
    {
        $nbs = [];
        for ($i = 0; $i < $nb; $i++) {
            $nbs[] = random_int($min, $max);
        }

        return new Response(implode("\n", $nbs));
    }
}
