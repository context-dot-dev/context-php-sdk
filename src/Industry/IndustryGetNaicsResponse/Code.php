<?php

declare(strict_types=1);

namespace ContextDev\Industry\IndustryGetNaicsResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Industry\IndustryGetNaicsResponse\Code\Confidence;

/**
 * @phpstan-type CodeShape = array{
 *   code: string, confidence: Confidence|value-of<Confidence>, name: string
 * }
 */
final class Code implements BaseModel
{
    /** @use SdkModel<CodeShape> */
    use SdkModel;

    /**
     * NAICS code.
     */
    #[Required]
    public string $code;

    /**
     * Confidence level for how well this NAICS code matches the company description.
     *
     * @var value-of<Confidence> $confidence
     */
    #[Required(enum: Confidence::class)]
    public string $confidence;

    /**
     * NAICS title.
     */
    #[Required]
    public string $name;

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
        string $name
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['confidence'] = $confidence;
        $self['name'] = $name;

        return $self;
    }

    /**
     * NAICS code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Confidence level for how well this NAICS code matches the company description.
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
     * NAICS title.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
