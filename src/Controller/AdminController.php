<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route(path="/number")
     */
    public function test(Request $request)
    {
        $from = (int) $request->query->get('offset', 0);
        $limit = (int) $request->query->get('limit', 100);

        $range = range($from , $from + $limit -1);

        if(in_array(666, $range)) {
            throw new HttpException(403,'This query is EVIL !');
        }

        foreach($range as $key){
            $range[$key] = $this->primeNumber($key);
        }

        //dd($range);

        return $this->render('Admin/number.html.twig', [
            'nbs' => $range,
        ]);
    }

    private function primeNumber(int $number) : bool
    {
        if ($number == 1 || $number == 0)
            return false;
        for ($i = 2; $i <= $number/2; $i++){
            if ($number % $i == 0)
                return false;
        }
        return true;
    }
}
