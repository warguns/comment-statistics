<?php

declare(strict_types=1);

namespace App\Infrastructure\Ai\Comments;

use App\Domain\Comment\CommentCollection;
use App\Domain\Comment\CommentEvaluator;
use App\Domain\Comment\CommentNotFoundException;
use OpenAI;

final class OpenAiCommentEvaluator implements CommentEvaluator
{
    private const PROMPT = "evalua las siguientes oraciones solo con \"1\" en el caso que la oracion sea 
    positiva y un \"0\" en el caso que sea negativa. Respóndeme con una lista de las respuestas separadas por coma:";
    private const AI_MODEL = 'text-davinci-002';

    /**
     * @throws \JsonException
     */
    public function checkComments(CommentCollection $commentCollection): array
    {
        if ($commentCollection->count() === 0) {
            throw new CommentNotFoundException();
        }

        $client = OpenAI::client($_ENV['OPENAI_API_KEY']);
        $prompt = self::PROMPT . $commentCollection->toPromptString();

        $promptConfiguration = [
            'model' => self::AI_MODEL,
            'prompt' => $prompt,
        ];

        $response = $client->completions()->create($promptConfiguration);

        if (preg_match('/^[a-zA-Z ]*$/', $response['choices'][0]['text'])) {
            $response = $client->completions()->create($promptConfiguration);
        }

        return explode(',', $response['choices'][0]['text']);
    }
}
