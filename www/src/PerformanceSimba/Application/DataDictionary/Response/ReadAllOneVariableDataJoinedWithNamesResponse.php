<?php


namespace App\PerformanceSimba\Application\DataDictionary\Response;


use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;

class ReadAllOneVariableDataJoinedWithNamesResponse
{
    private const VARIABLE_NAME_FIELD  = "firstVariableNames";
    private const VALUES_DATA_FIELD    = "values";
    private const ID_VARIABLE_FIELD    = "var1_id";
    private const VALUE_VARIABLE_FIELD = "value";
    private const NAME_VARIABLE_FIELD  = "name";

    private array $listOneVariableDataJoined;

    public function __construct(array $listOneVariableDataJoined)
    {
        $this->listOneVariableDataJoined = $listOneVariableDataJoined;
    }

    public function allOneVariableDataWithNamesAsArray(): array
    {
        return [
            self::VARIABLE_NAME_FIELD => array_map(array($this, "firstVariableDictionaryAsArray"),
                $this->listOneVariableDataJoined),
            self::VALUES_DATA_FIELD => array_map(array($this, "oneVariableDataAsArray"),
                $this->listOneVariableDataJoined)
        ];
    }

    private function firstVariableDictionaryAsArray(OneVariableDataJoined $oneVariableDataJoined): array
    {
        return [
            self::ID_VARIABLE_FIELD => $oneVariableDataJoined->firstVariableDictionary()->id(),
            self::NAME_VARIABLE_FIELD => $oneVariableDataJoined->firstVariableDictionary()->name()
        ];
    }

    private function oneVariableDataAsArray(OneVariableDataJoined $oneVariableDataJoined): array
    {
        return [
            self::ID_VARIABLE_FIELD => $oneVariableDataJoined->firstVariableDictionary()->id(),
            self::VALUE_VARIABLE_FIELD => $oneVariableDataJoined->value()
        ];
    }
}