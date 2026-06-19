<?php

declare(strict_types=1);

namespace ContextDev\Industry;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Industry\IndustryRetrieveSicParams\Type;

/**
 * Classify any brand into Standard Industrial Classification (SIC) codes from its domain or name. Choose between the original SIC system (`original_sic`) or the latest SIC list maintained by the SEC (`latest_sec`).
 *
 * @see ContextDev\Services\IndustryService::retrieveSic()
 *
 * @phpstan-type IndustryRetrieveSicParamsShape = array{
 *   input: string,
 *   maxResults?: int|null,
 *   minResults?: int|null,
 *   timeoutMs?: int|null,
 *   type?: null|Type|value-of<Type>,
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
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * Which SIC dataset to classify against. `original_sic` uses the 1987 Standard Industrial Classification system; `latest_sec` uses the current SIC list as published by the SEC. Defaults to `original_sic`.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

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
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $input,
        ?int $maxResults = null,
        ?int $minResults = null,
        ?int $timeoutMs = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['input'] = $input;

        null !== $maxResults && $self['maxResults'] = $maxResults;
        null !== $minResults && $self['minResults'] = $minResults;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $type && $self['type'] = $type;

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
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

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
}
