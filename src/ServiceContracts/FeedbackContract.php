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
     * @param Category|value-of<Category> $category kind of issue
     * @param string $note what went wrong and what you expected instead
     * @param string $requestID the request_id of the API call the feedback is about, from its response body or X-Request-Id header
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param string $url the page the feedback is about, such as one page of a crawl or a docs page
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
