<?php

declare(strict_types=1);

namespace App\Domain\Comment;

final class StatisticsCalculator
{
    public function calculate(array $commentMoodResults): CommentStatistics
    {
        $goodCount = array_sum($commentMoodResults);
        $badCount = (int) count($commentMoodResults) - $goodCount;

        return new CommentStatistics($badCount, $goodCount);
    }
}
