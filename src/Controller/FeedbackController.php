<?php

namespace App\Controller;

use App\Models\Feedback\Feedback;
use App\Models\Feedback\FeedbackFacade;
use App\Models\Feedback\FeedbackTranslator;
use Symfony\Component\HttpFoundation\JsonResponse;

class FeedbackController extends Controller
{
    private FeedbackFacade $feedbackFacade;

    private FeedbackTranslator $feedbackTranslator;

    public function __construct(
        FeedbackFacade $feedbackFacade,
        FeedbackTranslator $feedbackTranslator
    )
    {
        $this->feedbackFacade = $feedbackFacade;
        $this->feedbackTranslator = $feedbackTranslator;
    }

    /** @return array */
    public function getFeedbackList(): JsonResponse
    {
        $result = [];
        $feedbackList = $this->feedbackFacade->getFeedbackList();

        if ($feedbackList) {
            foreach ($feedbackList as $feedback) {
                $result[] = $this->feedbackTranslator->translate($feedback);
            }
        }

        return response()->json($result);
    }

    public function getFeedbackById(int $id): JsonResponse
    {
        $feedback = $this->feedbackFacade->getFeedbackById($id);
        if ( ! $feedback) {
            return response()->json(['error']);
        }

        return response()->json(
            $this->feedbackTranslator->translate($feedback)
        );
    }
}
