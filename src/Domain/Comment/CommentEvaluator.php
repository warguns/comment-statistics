<?php

declare(strict_types=1);

namespace App\Domain\Comment;

interface CommentEvaluator
{
    public function checkComments(CommentCollection $commentCollection): array;
}
