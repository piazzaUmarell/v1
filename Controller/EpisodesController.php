<?php

namespace Controller;

use Core\Controller;
use Core\Response\JsonResponse;
use Repositories\EpisodesRepository;

class EpisodesController extends Controller
{
    public function index()
    {
        return new JsonResponse(EpisodesRepository::all());
    }
}
