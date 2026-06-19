<?php

declare(strict_types=1);

namespace ContextDev\AI;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Extract product information from a brand's website. We will analyze the website and return a list of products with details such as name, description, image, pricing, features, and more.
 *
 * @see ContextDev\Services\AIService::extractProducts()
 *
 * @phpstan-type AIExtractProductsParamsShape = array{
 *   domain: string,
 *   maxAgeMs?: int|null,
 *   maxProducts?: int|null,
 *   timeoutMs?: int|null,
 *   directURL: string,
 * }
 */
final class AIExtractProductsParams implements BaseModel
{
    /** @use SdkModel<AIExtractProductsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The domain name to analyze.
     */
    #[Required]
    public string $domain;

    /**
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 7 days (604800000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Maximum number of products to extract.
     */
    #[Optional]
    public ?int $maxProducts;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

    /**
     * A specific URL to use directly as the starting point for extraction without domain resolution.
     */
    #[Required('directUrl')]
    public string $directURL;

    /**
     * `new AIExtractProductsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AIExtractProductsParams::with(domain: ..., directURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AIExtractProductsParams)->withDomain(...)->withDirectURL(...)
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
        string $domain,
        string $directURL,
        ?int $maxAgeMs = null,
        ?int $maxProducts = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;
        $self['directURL'] = $directURL;

        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $maxProducts && $self['maxProducts'] = $maxProducts;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * The domain name to analyze.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

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
     * Maximum number of products to extract.
     */
    public function withMaxProducts(int $maxProducts): self
    {
        $self = clone $this;
        $self['maxProducts'] = $maxProducts;

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

    /**
     * A specific URL to use directly as the starting point for extraction without domain resolution.
     */
    public function withDirectURL(string $directURL): self
    {
        $self = clone $this;
        $self['directURL'] = $directURL;

        return $self;
    }
}
