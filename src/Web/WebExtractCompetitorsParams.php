<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractCompetitorsParams\TimeoutOpts;

/**
 * Analyze a company's landing page and web search evidence to return direct competitors for the same product or market.
 *
 * @see ContextDev\Services\WebService::extractCompetitors()
 *
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebExtractCompetitorsParams\TimeoutOpts
 *
 * @phpstan-type WebExtractCompetitorsParamsShape = array{
 *   domain: string,
 *   numCompetitors?: int|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
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
     * Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

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
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     */
    public static function with(
        string $domain,
        ?int $numCompetitors = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;

        null !== $numCompetitors && $self['numCompetitors'] = $numCompetitors;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;

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
     * Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
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
     * Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }
}
