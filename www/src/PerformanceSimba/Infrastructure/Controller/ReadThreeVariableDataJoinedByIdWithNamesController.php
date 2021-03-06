<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\ReadThreeVariableDataJoinedByIdRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadThreeVariableDataJoinedByIdWithNamesUseCase;
use App\PerformanceSimba\Application\DataDictionary\Service\arrayUtility;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReadThreeVariableDataJoinedByIdWithNamesController
{
    private const FIELD_HEADER_VARS_1 = 'ids_1';
    private const FIELD_HEADER_VARS_2 = 'ids_2';
    private const FIELD_HEADER_VARS_3 = 'ids_3';

    private ReadThreeVariableDataJoinedByIdWithNamesUseCase $readThreeVariableDataJoinedByIdWithNamesUseCase;

    public function __construct(
        ReadThreeVariableDataJoinedByIdWithNamesUseCase $readThreeVariableDataJoinedByIdWithNamesUseCase
    ) {
        $this->readThreeVariableDataJoinedByIdWithNamesUseCase = $readThreeVariableDataJoinedByIdWithNamesUseCase;
    }

    public function execute(string $jsonRequest): Response
    {
        $dataRequest = json_decode($jsonRequest, true);

        $ids1 = arrayUtility::parseAssociativeArray($dataRequest, self::FIELD_HEADER_VARS_1);
        $ids2 = arrayUtility::parseAssociativeArray($dataRequest, self::FIELD_HEADER_VARS_2);
        $ids3 = arrayUtility::parseAssociativeArray($dataRequest, self::FIELD_HEADER_VARS_3);

        $startTime = microtime(1);

        $response = $this->readThreeVariableDataJoinedByIdWithNamesUseCase->execute(
            new ReadThreeVariableDataJoinedByIdRequest( $ids1, $ids2, $ids3 )
        );

        $duration = microtime(1) - $startTime;

        $result = [
            $response->threeVariableDataJoinedByIdWithNamesAsArray(),
            'duration' => $duration
        ];

        return new JsonResponse($result, Response::HTTP_OK);
    }

}