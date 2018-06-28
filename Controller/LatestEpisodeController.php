<?php

namespace Controller;

use Core\Controller;
use Core\Response\JsonResponse;

class LatestEpisodeController extends Controller
{
    public function show()
    {
        return new JsonResponse(['key' => 'value']);
    }
}
