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
 * Report bugs, wrong results, and docs mismatches to the Context.dev team.
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
     * Report a bug, docs mismatch, or wrong result to the Context.dev team. Send `request_id`, `url`, or both. Any API key can submit, and a repeat report for the same `request_id` returns the original feedback.
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
