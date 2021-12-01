<?php

namespace App\Http\Controllers;

use App\UseCase\HomeHomeCaseInterface;
use App\UseCase\HomeIndexCaseInterface;

/**
 * ホームページを表示するコントローラー
 */
class HomeController extends Controller
{
    protected $homeIndexCase;
    protected $homeHomeCase;

    public function __construct(
        HomeIndexCaseInterface $homeIndexCase,
        HomeHomeCaseInterface $homeHomeCase
    )
    {
        $this->homeIndexCase          = $homeIndexCase;
        $this->homeHomeCase           = $homeHomeCase;
    }

    public function index()
    {
        $index = $this->homeIndexCase->handle();

        return $index;
    }


    public function home(int $userId)
    {
        $home = $this->homeHomeCase->handle($userId);

        return $home;
    }
}
