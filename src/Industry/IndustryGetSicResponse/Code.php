<?php

declare(strict_types=1);

namespace ContextDev\Industry\IndustryGetSicResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Industry\IndustryGetSicResponse\Code\Confidence;

/**
 * @phpstan-type CodeShape = array{
 *   code: string,
 *   confidence: Confidence|value-of<Confidence>,
 *   name: string,
 *   majorGroup?: string|null,
 *   majorGroupName?: string|null,
 *   office?: string|null,
 * }
 */
final class Code implements BaseModel
{
    /** @use SdkModel<CodeShape> */
    use SdkModel;

    /**
     * SIC code (4-digit).
     */
    #[Required]
    public string $code;

    /**
     * Confidence level for how well this SIC code matches the company description.
     *
     * @var value-of<Confidence> $confidence
     */
    #[Required(enum: Confidence::class)]
    public string $confidence;

    /**
     * SIC industry title.
     */
    #[Required]
    public string $name;

    /**
     * 2-digit major group identifier (the leading two digits of the code). Only present when `classification` is `original_sic`.
     */
    #[Optional]
    public ?string $majorGroup;

    /**
     * Description of the 2-digit major group. Only present when `classification` is `original_sic`.
     */
    #[Optional]
    public ?string $majorGroupName;

    /**
     * SEC review office responsible for filings under this code. Only present when `classification` is `latest_sec`.
     */
    #[Optional]
    public ?string $office;

    /**
     * `new Code()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Code::with(code: ..., confidence: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Code)->withCode(...)->withConfidence(...)->withName(...)
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
     * @param Confidence|value-of<Confidence> $confidence
     */
    public static function with(
        string $code,
        Confidence|string $confidence,
        string $name,
        ?string $majorGroup = null,
        ?string $majorGroupName = null,
        ?string $office = null,
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['confidence'] = $confidence;
        $self['name'] = $name;

        null !== $majorGroup && $self['majorGroup'] = $majorGroup;
        null !== $majorGroupName && $self['majorGroupName'] = $majorGroupName;
        null !== $office && $self['office'] = $office;

        return $self;
    }

    /**
     * SIC code (4-digit).
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Confidence level for how well this SIC code matches the company description.
     *
     * @param Confidence|value-of<Confidence> $confidence
     */
    public function withConfidence(Confidence|string $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * SIC industry title.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * 2-digit major group identifier (the leading two digits of the code). Only present when `classification` is `original_sic`.
     */
    public function withMajorGroup(string $majorGroup): self
    {
        $self = clone $this;
        $self['majorGroup'] = $majorGroup;

        return $self;
    }

    /**
     * Description of the 2-digit major group. Only present when `classification` is `original_sic`.
     */
    public function withMajorGroupName(string $majorGroupName): self
    {
        $self = clone $this;
        $self['majorGroupName'] = $majorGroupName;

        return $self;
    }

    /**
     * SEC review office responsible for filings under this code. Only present when `classification` is `latest_sec`.
     */
    public function withOffice(string $office): self
    {
        $self = clone $this;
        $self['office'] = $office;

        return $self;
    }
}
