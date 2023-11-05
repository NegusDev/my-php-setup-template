<?php

declare(strict_types=1);

namespace controllers;

use core\Controller;
use helpers\Response;


class pagesController extends Controller
{
    protected $exampleModel;
    protected $modeModel;
    public function __construct()
    {

        $this->exampleModel = $this->loadModel('Example');
        $this->modeModel = $this->loadModel('Mode');
        // IMPORT MODELS HERE
    }

    public function index(): Response
    {
        $data = [
            'title' => 'Welcome to my page',
            'datas' => ['Item 1', 'Item 2', 'Item 3'],
            'name' => $this->modeModel->setName(),
        ];

        return Response::send($data);
    }


    public function home()
    {
        $data = [
            'title' => 'Welcome to my page',
            'datas' => ['Item 1', 'Item 2', 'Item 3'],
            'name' => $this->modeModel->setName(),
        ];
        $this->loadView('home', $data);
    }
}
