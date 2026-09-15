<?php

declare(strict_types=1);

namespace ContextDev\Industry;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Industry\IndustryRetrieveNaicsParams\TimeoutOpts;

/**
 * Classify any brand into 2022 NAICS industry codes from its domain or name.
 *
 * @see ContextDev\Services\IndustryService::retrieveNaics()
 *
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Industry\IndustryRetrieveNaicsParams\TimeoutOpts
 *
 * @phpstan-type IndustryRetrieveNaicsParamsShape = array{
 *   input: string,
 *   maxResults?: int|null,
 *   minResults?: int|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 * }
 */
final class IndustryRetrieveNaicsParams implements BaseModel
{
    /** @use SdkModel<IndustryRetrieveNaicsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Brand domain or title to retrieve NAICS code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     */
    #[Required]
    public string $input;

    /**
     * Maximum number of NAICS codes to return. Must be between 1 and 10. Defaults to 5.
     */
    #[Optional]
    public ?int $maxResults;

    /**
     * Minimum number of NAICS codes to return. Must be at least 1. Defaults to 1.
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
     * `new IndustryRetrieveNaicsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IndustryRetrieveNaicsParams::with(input: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IndustryRetrieveNaicsParams)->withInput(...)
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
        string $input,
        ?int $maxResults = null,
        ?int $minResults = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
    ): self {
        $self = new self;

        $self['input'] = $input;

        null !== $maxResults && $self['maxResults'] = $maxResults;
        null !== $minResults && $self['minResults'] = $minResults;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }

    /**
     * Brand domain or title to retrieve NAICS code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     */
    public function withInput(string $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Maximum number of NAICS codes to return. Must be between 1 and 10. Defaults to 5.
     */
    public function withMaxResults(int $maxResults): self
    {
        $self = clone $this;
        $self['maxResults'] = $maxResults;

        return $self;
    }

    /**
     * Minimum number of NAICS codes to return. Must be at least 1. Defaults to 1.
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
}
