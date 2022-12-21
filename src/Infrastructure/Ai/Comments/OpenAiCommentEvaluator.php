<?php

declare(strict_types=1);

namespace App\Infrastructure\Ai\Comments;

use App\Domain\Comment\CommentCollection;
use App\Domain\Comment\CommentEvaluator;
use App\Domain\Comment\CommentNotFoundException;
use OpenAI;

final class OpenAiCommentEvaluator implements CommentEvaluator
{
    private const PROMPT = "evalua los siguientes comentarios respondiendo con \"1\" si es un comentario positivo y un 
    \"0\" si es negativo, respondiendo asi el resultado, en una lista tambien:";
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

        $response = $client->completions()->create([
            'model' => self::AI_MODEL,
            'prompt' => $prompt,
        ]);

        return json_decode($response['choices'][0]['text'], false, 512, JSON_THROW_ON_ERROR);
    }
}