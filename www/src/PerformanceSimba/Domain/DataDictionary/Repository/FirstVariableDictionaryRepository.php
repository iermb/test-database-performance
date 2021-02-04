<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;

interface FirstVariableDictionaryRepository
{
    public function save(FirstVariableDictionary $firstVariableDictionary): void;

    public function clean(): void;
}