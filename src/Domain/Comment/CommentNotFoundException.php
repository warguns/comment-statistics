<?php

declare(strict_types=1);

namespace App\Domain\Comment;

use App\Domain\DomainException\DomainRecordNotFoundException;

final class CommentNotFoundException extends DomainRecordNotFoundException
{
    public function __construct()
    {
        parent::__construct("No comments found to evaluate");
    }
}
