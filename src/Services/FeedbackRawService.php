<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Feedback\FeedbackSubmitParams;
use ContextDev\Feedback\FeedbackSubmitParams\Category;
use ContextDev\Feedback\FeedbackSubmitResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\FeedbackRawContract;

/**
 * Report bugs, wrong results, and docs mismatches to the Context.dev team.
 *
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class FeedbackRawService implements FeedbackRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Report a bug, docs mismatch, or wrong result to the Context.dev team. Send `request_id`, `url`, or both. Any API key can submit, and a repeat report for the same `request_id` returns the original feedback.
     *
     * @param array{
     *   category: value-of<Category>,
     *   note: string,
     *   requestID?: string,
     *   tags?: list<string>,
     *   url?: string,
     * }|FeedbackSubmitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeedbackSubmitResponse>
     *
     * @throws APIException
     */
    public function submit(
        array|FeedbackSubmitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FeedbackSubmitParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'feedback',
            body: (object) $parsed,
            options: $options,
            convert: FeedbackSubmitResponse::class,
        );
    }
}
