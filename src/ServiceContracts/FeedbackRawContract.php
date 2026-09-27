<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Feedback\FeedbackSubmitParams;
use ContextDev\Feedback\FeedbackSubmitResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface FeedbackRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|FeedbackSubmitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeedbackSubmitResponse>
     *
     * @throws APIException
     */
    public function submit(
        array|FeedbackSubmitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
