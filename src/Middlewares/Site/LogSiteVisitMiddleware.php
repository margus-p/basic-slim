<?php

declare(strict_types=1);

namespace App\Middlewares\Site;

use App\Model\SiteVisit;
use App\Repositories\Contracts\Site\SiteVisitRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

/**
 * Middleware that logs site visits for statistics purposes.
 */
class LogSiteVisitMiddleware
{
    private SiteVisitRepositoryInterface $siteVisitRepository;

    public function __construct(SiteVisitRepositoryInterface $siteVisitRepository)
    {
        $this->siteVisitRepository = $siteVisitRepository;
    }

    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        $this->addSiteVisit($request);
        return $handler->handle($request);

    }

    private function addSiteVisit(Request $request): void
    {
        $siteVisit = $this->buildFromRequest($request);

        $this->siteVisitRepository->persist($siteVisit);
        $this->siteVisitRepository->saveSingle($siteVisit);

    }

    private function buildFromRequest(Request $request): SiteVisit
    {
        $serverParams = $request->getServerParams();

        $siteVisit = new SiteVisit();
        $siteVisit
            ->setIpAddress($serverParams["REMOTE_ADDR"] ?? "")
            ->setUserAgent($serverParams["HTTP_USER_AGENT"] ?? "")
            ->setUrl($serverParams["REQUEST_URI"] ?? "")
            ->setReferrer(!empty($serverParams["HTTP_REFERER"]) ? $serverParams["HTTP_REFERER"] : null);

        return $siteVisit;

    }

}
