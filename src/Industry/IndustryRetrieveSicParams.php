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
 * Classify any brand into Standard Industrial Classification (SIC) codes from its domain or name. Choose between the original SIC system (`original_sic`) or the latest SIC list maintained by the SEC (`latest_sec`).
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
     * Which SIC dataset to classify against. `original_sic` uses the 1987 Standard Industrial Classification system; `latest_sec` uses the current SIC list as published by the SEC. Defaults to `original_sic`.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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

    /**
     * Which SIC dataset to classify against. `original_sic` uses the 1987 Standard Industrial Classification system; `latest_sec` uses the current SIC list as published by the SEC. Defaults to `original_sic`.
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
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
