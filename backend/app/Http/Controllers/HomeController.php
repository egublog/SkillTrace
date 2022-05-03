<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\UseCase\HomeHomeCaseInterface;
use App\UseCase\HomeIndexCaseInterface;
use Illuminate\Contracts\View\View;

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

    public function index(): View
    {
        $index = $this->homeIndexCase->handle();

        return $index;
    }


    public function home(int $userId): View
    {
        $home = $this->homeHomeCase->handle($userId);

        return $home;
    }
}
