<?php

namespace App\Controller;

use App\Feedback\FeedbackFacade;
use App\Feedback\FeedbackFactory;
use App\Feedback\FeedbackTranslator;
use App\Logger\LoggerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FeedbackController extends AbstractController
{
    private FeedbackFacade $feedbackFacade;

    private FeedbackTranslator $feedbackTranslator;

    private FeedbackFactory $feedbackFactory;

    private LoggerService $loggerService;

    public function __construct(
        FeedbackFacade $feedbackFacade,
        FeedbackTranslator $feedbackTranslator,
        FeedbackFactory $feedbackFactory,
        LoggerService $loggerService
    )
    {
        $this->feedbackFacade = $feedbackFacade;
        $this->feedbackTranslator = $feedbackTranslator;
        $this->feedbackFactory = $feedbackFactory;
        $this->loggerService = $loggerService;
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
        try {
            $this->validate($feedback);
            $this->feedbackFacade->saveFeedback(
                $this->feedbackFactory->createFeedbackFromArray($feedback)
            );
            $this->loggerService->write($feedback);
        } catch (\Exception $exception) {
            return $this->json($exception);
        }

        return $this->json(['status' => 'ok', 'feedback' => $feedback]);
    }

    private function validate(array $feedback): void
    {
        if (empty($feedback['name'])) {
            throw new BadRequestHttpException('Message cannot be empty');
        }
        if (empty($feedback['phone'])) {
            throw new BadRequestHttpException('Message cannot be empty');
        }
        if (empty($feedback['message'])) {
            throw new BadRequestHttpException('Message cannot be empty');
        }
    }
}
