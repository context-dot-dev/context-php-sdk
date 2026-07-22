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
 *   domain: string,
 *   numCompetitors?: int|null,
 *   tags?: list<string>|null,
 *   timeoutMs?: int|null,
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
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

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
     *
     * @param list<string>|null $tags
     */
    public static function with(
        string $domain,
        ?int $numCompetitors = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;

        null !== $numCompetitors && $self['numCompetitors'] = $numCompetitors;
        null !== $tags && $self['tags'] = $tags;
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
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

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
