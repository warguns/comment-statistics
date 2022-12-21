<?php

declare(strict_types=1);

use App\Domain\Comment\CommentEvaluator;
use App\Infrastructure\Ai\Comments\OpenAiCommentEvaluator;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        CommentEvaluator::class => autowire(OpenAiCommentEvaluator::class),
    ]);
};
