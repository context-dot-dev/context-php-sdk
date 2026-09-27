<?php

declare(strict_types=1);

namespace ContextDev\Industry;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Industry\IndustryRetrieveSicParams\TimeoutOpts;
use ContextDev\Industry\IndustryRetrieveSicParams\Type;
use ContextDev\Industry\IndustryRetrieveSicParams\Zdr;

/**
 * Classify a company into SIC industry codes.
 *
 * @see ContextDev\Services\IndustryService::retrieveSic()
 *
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Industry\IndustryRetrieveSicParams\TimeoutOpts
 *
 * @phpstan-type IndustryRetrieveSicParamsShape = array{
 *   input: string,
 *   maxResults?: int|null,
 *   minResults?: int|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   type?: null|Type|value-of<Type>,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class IndustryRetrieveSicParams implements BaseModel
{
    /** @use SdkModel<IndustryRetrieveSicParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Brand domain or title to retrieve SIC code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     */
    #[Required]
    public string $input;

    /**
     * Maximum number of SIC codes to return. Must be between 1 and 10. Defaults to 5.
     */
    #[Optional]
    public ?int $maxResults;

    /**
     * Minimum number of SIC codes to return. Must be at least 1. Defaults to 1.
     */
    #[Optional]
    public ?int $minResults;

    /**
     * Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Request deadline and what to return when it passes.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * SIC dataset: `original_sic` (1987) or `latest_sec` (current SEC list).
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new IndustryRetrieveSicParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IndustryRetrieveSicParams::with(input: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IndustryRetrieveSicParams)->withInput(...)
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
     * @param Type|value-of<Type>|null $type
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $input,
        ?int $maxResults = null,
        ?int $minResults = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Type|string|null $type = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['input'] = $input;

        null !== $maxResults && $self['maxResults'] = $maxResults;
        null !== $minResults && $self['minResults'] = $minResults;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $type && $self['type'] = $type;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Brand domain or title to retrieve SIC code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     */
    public function withInput(string $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Maximum number of SIC codes to return. Must be between 1 and 10. Defaults to 5.
     */
    public function withMaxResults(int $maxResults): self
    {
        $self = clone $this;
        $self['maxResults'] = $maxResults;

        return $self;
    }

    /**
     * Minimum number of SIC codes to return. Must be at least 1. Defaults to 1.
     */
    public function withMinResults(int $minResults): self
    {
        $self = clone $this;
        $self['minResults'] = $minResults;

        return $self;
    }

    /**
     * Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
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
     * Request deadline and what to return when it passes.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }

    /**
     * SIC dataset: `original_sic` (1987) or `latest_sec` (current SEC list).
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @param Zdr|value-of<Zdr> $zdr
     */
    public function withZdr(Zdr|string $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }
}
