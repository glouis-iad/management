<?php
namespace App\Service;


use App\Traits\ApiResponseTrait;

abstract class AbstractService
{
    /**
     * Using Service trait Response methods
     */
    use ApiResponseTrait;

    /**
     * @param  $violations
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalizeViolations($violations, $format = null)
    {
        //[$messages, $violations] = $this->getMessagesAndViolations($object);
        //dd($violations);
        return [
            //'message' => $messages ? implode("\n", $messages) : 'Une erreur est survenue',
            'form2222' => $violations,
        ];
    }

    /**
     * @param $constraintViolationList
     * @return array
     */
    public function getMessagesAndViolations($constraintViolationList): array
    {
        $violations = $messages = [];

        foreach ($constraintViolationList as $violation) {
            $violations[] = [
                $violation->getPropertyPath() => $violation->getMessage() ,
            ];

            $propertyPath = $violation->getPropertyPath();
            //$messages[] = ($propertyPath ? $propertyPath.': ' : '').$violation->getMessage();
            $messages[] = $violation->getMessage();

        }

        return array_filter([
            //'message' => $messages ?: implode("\n ", $messages),
            'errors' => $violations,
        ]);

    }

    /**
     * @param $constraintViolationList
     * @return array|\array[][]
     */
    public function getDetailsViolations($constraintViolationList): array
    {
        $violations = $messages = [];

        foreach ($constraintViolationList as $violation) {
            $violations[$violation->getPropertyPath()] = $violation->getMessage();
        }

        if(!$violations){
            return [];
        }

        return array_filter([
            'detail' => [$violations]
        ]);
    }
}
