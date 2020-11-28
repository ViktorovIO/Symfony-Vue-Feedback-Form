<?php

namespace App\Feedback;

use App\Entity\Feedback;

class FeedbackFacade
{
    private FeedbackRepository $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /** @return null|Feedback[] */
    public function getFeedbackList(): array
    {
        return $this->feedbackRepository->getFeedbackList();
    }

    public function getFeedbackById(int $id): ?Feedback
    {
        return $this->feedbackRepository->getFeedbackById($id);
    }

    public function saveFeedback(Feedback $feedback): void
    {
        $this->feedbackRepository->saveFeedback($feedback);
    }
}
