<?php

namespace Controller;

use Core\Controller;
use Core\Response\JsonResponse;
use Repositories\EpisodesRepository;

class LatestEpisodeController extends Controller
{
    public function show()
    {
        return new JsonResponse(EpisodesRepository::getLatest());
    }
}
