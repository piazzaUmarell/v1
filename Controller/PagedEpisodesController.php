<?php

namespace Controller;

use Core\Controller;
use Core\Response\JsonResponse;
use Repositories\EpisodesRepository;

class PagedEpisodesController extends Controller
{
    const EPISODES_PER_PAGE = 5;

    public function show(int $page)
    {
        return new JsonResponse(
            EpisodesRepository::page(
                $page,
                self::EPISODES_PER_PAGE
            )
        );
    }
}
