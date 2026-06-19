<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Analyze a company's landing page and web search evidence to return direct competitors for the same product or market.
 *
 * @see ContextDev\Services\WebService::extractCompetitors()
 *
 * @phpstan-type WebExtractCompetitorsParamsShape = array{
 *   domain: string, numCompetitors?: int|null, timeoutMs?: int|null
 * }
 */
final class WebExtractCompetitorsParams implements BaseModel
{
    /** @use SdkModel<WebExtractCompetitorsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Company domain to analyze, such as `stripe.com`. Full http(s) URLs are accepted and normalized to their domain.
     */
    #[Required]
    public string $domain;

    /**
     * Exact number of direct competitors to return. Defaults to 5.
     */
    #[Optional]
    public ?int $numCompetitors;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * `new WebExtractCompetitorsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebExtractCompetitorsParams::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebExtractCompetitorsParams)->withDomain(...)
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
        ?int $numCompetitors = null,
        ?int $timeoutMs = null
    ): self {
        $self = new self;

        $self['domain'] = $domain;

        null !== $numCompetitors && $self['numCompetitors'] = $numCompetitors;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Company domain to analyze, such as `stripe.com`. Full http(s) URLs are accepted and normalized to their domain.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Exact number of direct competitors to return. Defaults to 5.
     */
    public function withNumCompetitors(int $numCompetitors): self
    {
        $self = clone $this;
        $self['numCompetitors'] = $numCompetitors;

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
