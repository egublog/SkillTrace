<?php

declare(strict_types=1);

namespace App\UseCase\Activity;

use App\UseCase\ActivityIndexCaseInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use stdClass;

final class ActivityIndexCase implements ActivityIndexCaseInterface
{

    private $activityRepository;

    public function __construct(
        ActivityRepositoryInterface $activityRepository
    ) {
        $this->activityRepository = $activityRepository;
    }

    /**
     *
     * @return 
     */
    public function handle()
    {

    }
}
