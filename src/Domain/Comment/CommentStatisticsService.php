<?php

declare(strict_types=1);

namespace App\Domain\Comment;

final class CommentStatisticsService
{
    private CommentEvaluator $commentEvaluator;
    private StatisticsCalculator $statisticsEvaluator;

    public function __construct(
        CommentEvaluator $commentEvaluator,
        StatisticsCalculator $statisticsEvaluator
    ) {
        $this->commentEvaluator = $commentEvaluator;
        $this->statisticsEvaluator = $statisticsEvaluator;
    }

    /**
     * @throws CommentNotFoundException
     */
    public function run(array $comments): CommentStatistics
    {
        $commentMoodResults = $this->commentEvaluator->checkComments(CommentCollection::fromCommentArray($comments));

        return $this->statisticsEvaluator->calculate($commentMoodResults);
    }
}
