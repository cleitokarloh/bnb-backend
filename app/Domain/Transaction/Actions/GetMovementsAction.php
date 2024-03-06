<?php

namespace Domain\Transaction\Actions;

use Domain\Transaction\Models\Movement;
use Domain\Transaction\Repositories\MovementRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class GetMovementsAction
{
    public function __construct(private MovementRepository $movementRepository)
    {
    }

    public function __invoke(): Collection
    {
        Gate::authorize('index', Movement::class);

        $movements = $this->movementRepository->get(auth()->user()->id);

        return $movements;
    }
}
