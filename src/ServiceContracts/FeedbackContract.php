<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Feedback\FeedbackSubmitParams\Category;
use ContextDev\Feedback\FeedbackSubmitResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface FeedbackContract
{
    /**
     * @api
     *
     * @param Category|value-of<Category> $category Kind of issue. Use `quality_degradation` for wrong or incomplete results and `bad_brand` for wrong or outdated brand data, such as a logo or colors.
     * @param string $note What went wrong and what you expected instead. Leave out API keys and personal data.
     * @param string $requestID ID of the API call the feedback is about, from its `request_id` or `X-Request-Id` header. Send this, `url`, or both.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param string $url URL the feedback is about, such as one page of a crawl or a docs page. Send this, `request_id`, or both.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        Category|string $category,
        string $note,
        ?string $requestID = null,
        ?array $tags = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeedbackSubmitResponse;
}
