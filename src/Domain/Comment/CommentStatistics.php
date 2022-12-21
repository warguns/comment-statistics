<?php

declare(strict_types=1);

namespace App\Domain\Comment;

final class CommentStatistics
{
    private const PERCENT = 100;
    private int $badCount;
    private int $goodCount;

    public function __construct(
        int $badCount,
        int $goodCount
    ) {
        $this->badCount = $badCount;
        $this->goodCount = $goodCount;
    }

    public function statistics(): float
    {
        return $this->goodCount / ($this->badCount + $this->goodCount) * self::PERCENT;
    }
}
