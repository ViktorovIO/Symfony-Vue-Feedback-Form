<?php

namespace App\Feedback;

use App\Entity\Feedback;
use Doctrine\DBAL\Connection;

class FeedbackRepository
{
    private const TABLE_NAME = '`feedback_db`.`feedback`';

    private Connection $dbal;

    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    /** @return null|Feedback[] */
    public function getFeedbackList(): ?array
    {
        $result = [];
        $feedbackCollection = $this->dbal->fetchAllAssociative("SELECT * FROM " . self::TABLE_NAME);

        if ( ! $feedbackCollection) {
            return null;
        }

        foreach ($feedbackCollection as $feedback) {
            $result[] = $this->getFeedback($feedback);
        }
        return $result;
    }

    public function getFeedbackById(int $id): ?Feedback
    {
        $feedback = DB::table('feedback')->get()->where('id', '=', $id);

        if (empty($feedback)) {
            return null;
        }

        foreach ($feedback as $item) {
            $result = $this->getFeedback($item);
        }

        return $result;
    }

    public function saveFeedback(Feedback $feedback): void
    {
        $this->dbal->executeQuery(
            "INSERT INTO " . self::FEEDBACK_TABLE . "
            SET `id`=:id,
                `name`=:name,
                `phone`=:phone,
                `message`=:message
            ON DUPLICATE KEY UPDATE
                
            ", [
                'id' => $feedback->getId(),
                'name' => $feedback->getName(),
                'phone' => $feedback->getPhone(),
                'message' => $feedback->getMessage()
        ], []
        );

        if ( ! $feedback->getId()) {
            $feedback->setId($this->dbal->lastInsertId());
        }
    }

    private function getFeedback(array $feedbackArray): Feedback
    {
        return new Feedback(
            $feedbackArray['id'],
            $feedbackArray['name'],
            $feedbackArray['phone'],
            $feedbackArray['message']
        );
    }
}
