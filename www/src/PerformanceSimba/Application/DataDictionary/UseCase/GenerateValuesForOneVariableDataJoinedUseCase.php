<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataJoinedRequest;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;

class GenerateValuesForOneVariableDataJoinedUseCase
{
    private OneVariableDataJoinedRepository         $oneVariableDataJoinedRepository;
    private FirstVariableDictionaryJoinedRepository $firstVariableDictionaryJoinedRepository;

    public function __construct(
        OneVariableDataJoinedRepository $oneVariableDataJoinedRepository,
        FirstVariableDictionaryJoinedRepository $firstVariableDictionaryJoinedRepository
    ) {
        $this->oneVariableDataJoinedRepository = $oneVariableDataJoinedRepository;
        $this->firstVariableDictionaryJoinedRepository = $firstVariableDictionaryJoinedRepository;
    }

    public function execute(GenerateValuesForOneVariableDataJoinedRequest $request): void
    {
        $this->oneVariableDataJoinedRepository->clean();
        $this->firstVariableDictionaryJoinedRepository->clean();

        $arrayFirstVariableDictionaryJoined = array_map(array($this, "generateFirstVariableDictionaryJoined"),
            range(0, $request->numberOfVariables()));

        $this->oneVariableDataJoinedRepository->saveMultiple(array_map(array($this, "generateOneVariableDataJoined"),
            $arrayFirstVariableDictionaryJoined));
    }

    private function generateFirstVariableDictionaryJoined(int $id): FirstVariableDictionaryJoined
    {
        return new FirstVariableDictionaryJoined($id, "Test name " . $id);
    }

    private function generateOneVariableDataJoined(FirstVariableDictionaryJoined $firstVariableDictionaryJoined
    ): OneVariableDataJoined {
        return new OneVariableDataJoined($firstVariableDictionaryJoined, rand(0, 1000000) / 100);
    }
}