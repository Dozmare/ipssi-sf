<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/admin")
 */
class AdminController
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

        return new JsonResponse($range);
    }
}
