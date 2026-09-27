<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\Feedback\FeedbackSubmitParams\Category;
use ContextDev\Feedback\FeedbackSubmitResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\FeedbackContract;

/**
 * Report bugs, docs mismatches, and friction with any Context.dev API. Submissions cost no credits and use a separate rate limit.
 *
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class FeedbackService implements FeedbackContract
{
    /**
     * @api
     */
    public FeedbackRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FeedbackRawService($client);
    }

    /**
     * @api
     *
     * Report a problem with a Context.dev API call, docs page, SDK, or CLI. Include request_id, url, or both.
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
    ): FeedbackSubmitResponse {
        $params = Util::removeNulls(
            [
                'category' => $category,
                'note' => $note,
                'requestID' => $requestID,
                'tags' => $tags,
                'url' => $url,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
