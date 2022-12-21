<?php

declare(strict_types=1);

namespace App\Domain\Comment;

final class CommentCollection
{
    private array $comments;

    protected function __construct(array $comments)
    {
        $this->comments = $comments;
    }

    /**
     * @throws CommentNotFoundException
     */
    public static function fromCommentArray(array $comments): self
    {
        return new self($comments);
    }

    public function count(): int
    {
        return count($this->comments);
    }

    public function toPromptString(): string
    {
        return '["' . implode('","', $this->comments) . '"]';
    }
}
