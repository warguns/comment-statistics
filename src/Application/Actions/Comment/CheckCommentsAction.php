<?php

declare(strict_types=1);

namespace App\Application\Actions\Comment;

use App\Application\Actions\Action;
use App\Domain\Comment\CommentStatisticsService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

final class CheckCommentsAction extends Action
{
    private CommentStatisticsService $commentStatisticsService;

    public function __construct(
        LoggerInterface $logger,
        CommentStatisticsService $commentStatisticsService
    ) {
        parent::__construct($logger);
        $this->commentStatisticsService = $commentStatisticsService;
    }

    public function action(): Response
    {
        $comments = $this->request->getParsedBody()['comments'];

        $commentStatistics = $this->commentStatisticsService->run($comments);

        return $this->respondWithData(["statistics" => $commentStatistics->statistics()]);
    }
}
