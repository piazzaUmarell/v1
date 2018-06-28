<?php

namespace Controller;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->view->share([
            'podcast_title' => 'Piazza Umarell',
            'podcast_description' => 'Il podcast per pezzi di nerd',
            'podcast_caption' => 'Prossimo episodio... Domenica. Tutte le domeniche!'
        ]);
    }
}
