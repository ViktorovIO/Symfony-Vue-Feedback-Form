<?php

namespace App\Feedback;

use Illuminate\Support\Facades\DB;

class FeedbackRepository
{
    /** @return null|Feedback[] */
    public function getFeedbackList(): ?array
    {
        $result = [];
        $feedbackCollection = DB::table('feedback')->get();

        if (empty($feedbackCollection)) {
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
