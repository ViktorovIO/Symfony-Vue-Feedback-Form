<?php

namespace App\Feedback;

class FeedbackTranslator
{
    /**
     * @param Feedback $feedback
     * @return array
     */
    public function translate(Feedback $feedback): array
    {
        $result['id'] = $feedback->getId();
        $result['name'] = $feedback->getName();
        $result['phone'] = $feedback->getPhone();
        $result['message'] = $feedback->getMessage();

        return $result;
    }
}
