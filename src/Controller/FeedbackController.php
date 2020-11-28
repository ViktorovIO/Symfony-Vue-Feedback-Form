<?php

namespace App\Controller;

use App\Feedback\FeedbackFacade;
use App\Feedback\FeedbackTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FeedbackController extends AbstractController
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

    /** @return JsonResponse */
    public function getFeedbackList(): JsonResponse
    {
        $result = [];
        $feedbackList = $this->feedbackFacade->getFeedbackList();

        if ($feedbackList) {
            foreach ($feedbackList as $feedback) {
                $result[] = $this->feedbackTranslator->translate($feedback);
            }
        }

        return $this->json($result);
    }

    /** @param int $id @return JsonResponse */
    public function getFeedbackById(int $id): JsonResponse
    {
        $feedback = $this->feedbackFacade->getFeedbackById($id);
        if ( ! $feedback) {
            return $this->json(['error']);
        }

        return $this->json(
            $this->feedbackTranslator->translate($feedback)
        );
    }

    public function post(Request $request)
    {

    }
}
