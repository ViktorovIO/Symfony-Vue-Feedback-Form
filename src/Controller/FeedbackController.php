<?php

namespace App\Controller;

use App\Feedback\FeedbackFacade;
use App\Feedback\FeedbackFactory;
use App\Feedback\FeedbackTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FeedbackController extends AbstractController
{
    private FeedbackFacade $feedbackFacade;

    private FeedbackTranslator $feedbackTranslator;

    private FeedbackFactory $feedbackFactory;

    public function __construct(
        FeedbackFacade $feedbackFacade,
        FeedbackTranslator $feedbackTranslator,
        FeedbackFactory $feedbackFactory
    )
    {
        $this->feedbackFacade = $feedbackFacade;
        $this->feedbackTranslator = $feedbackTranslator;
        $this->feedbackFactory = $feedbackFactory;
    }

    /** @return JsonResponse */
    public function getFeedbackList(): JsonResponse
    {
        $result = [];
        try {
            $feedbackList = $this->feedbackFacade->getFeedbackList();
        } catch (\Exception $e) {
            return $this->json($e);
        }

        if ($feedbackList) {
            foreach ($feedbackList as $feedback) {
                $result[] = $this->feedbackTranslator->translate($feedback);
            }
        }

        return $this->json($result);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request): JsonResponse
    {
        $feedback = $request->request->all();
        if (empty($feedback['message'])) {
            throw new BadRequestHttpException('Message cannot be empty');
        }

        try {
            $this->feedbackFacade->saveFeedback(
                $this->feedbackFactory->createFeedbackFromArray($feedback)
            );
        } catch (\Exception $exception) {
            return $this->json($exception);
        }

        return $this->json(['status' => 'ok', 'feedback' => $feedback]);
    }
}
