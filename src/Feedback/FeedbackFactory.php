<?php

namespace App\Feedback;

use App\Entity\Feedback;

class FeedbackFactory
{
    /**
     * @param array $feedbackArray
     * @return Feedback
     */
    public function createFeedbackFromArray(array $feedbackArray): Feedback
    {
        return new Feedback(
            $feedbackArray['id'] ?? null,
            $feedbackArray['name'],
            $feedbackArray['phone'],
            $feedbackArray['message']
        );
    }
}