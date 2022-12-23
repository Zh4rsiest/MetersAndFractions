<?php

namespace App\Http\Controllers;

use App\Interfaces\FractionReadServiceInterface;
use App\Interfaces\FractionWriteServiceInterface;
use App\LogMessages\FractionLogMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FractionController extends Controller
{
    public function __construct(
        private FractionReadServiceInterface $fractionReadRepository,
        private FractionWriteServiceInterface $fractionWriteRepository
    ) { }

    public function store(Request $request) {
        $fractions = $request->toArray();

        if (!$this->fractionReadRepository->areSumOfFractionsEqualOne($fractions)) {
            Log::error(FractionLogMessages::fractionsSumNotEqualOne($fractions[0]['profile']));
            return;
        }

        $this->fractionWriteRepository->insertMultiple($fractions);
    }

    public function delete($id) {
        $this->fractionWriteRepository->delete($id);
    }

    public function update($id, Request $request) {
        return $this->fractionWriteRepository->update($id, $request->toArray())->toJson();
    }

    public function find($id) {
        return $this->fractionReadRepository->find($id)->toJson();
    }
}
