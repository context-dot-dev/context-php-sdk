<?php

declare(strict_types=1);

namespace ContextDev\AI;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Given a single URL, determines if it is a product page and extracts the product information.
 *
 * @see ContextDev\Services\AIService::extractProduct()
 *
 * @phpstan-type AIExtractProductParamsShape = array{
 *   url: string, maxAgeMs?: int|null, timeoutMs?: int|null
 * }
 */
final class AIExtractProductParams implements BaseModel
{
    /** @use SdkModel<AIExtractProductParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The product page URL to extract product data from.
     */
    #[Required]
    public string $url;

    /**
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 7 days (604800000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

    /**
     * `new AIExtractProductParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AIExtractProductParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AIExtractProductParams)->withURL(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $url,
        ?int $maxAgeMs = null,
        ?int $timeoutMs = null
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * The product page URL to extract product data from.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 7 days (604800000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     */
    public function withMaxAgeMs(int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
