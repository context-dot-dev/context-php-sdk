<?php

declare(strict_types=1);

namespace ContextDev\AI\AIAIQueryResponse;

use ContextDev\AI\AIAIQueryResponse\DataExtracted\DatapointValue;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DatapointValueVariants from \ContextDev\AI\AIAIQueryResponse\DataExtracted\DatapointValue
 * @phpstan-import-type DatapointValueShape from \ContextDev\AI\AIAIQueryResponse\DataExtracted\DatapointValue
 *
 * @phpstan-type DataExtractedShape = array{
 *   datapointName?: string|null, datapointValue?: DatapointValueShape|null
 * }
 */
final class DataExtracted implements BaseModel
{
    /** @use SdkModel<DataExtractedShape> */
    use SdkModel;

    /**
     * Name of the extracted data point.
     */
    #[Optional('datapoint_name')]
    public ?string $datapointName;

    /**
     * Value of the extracted data point. Can be a primitive type, an array of primitives, or an array of objects when datapoint_list_type is 'object'.
     *
     * @var DatapointValueVariants|null $datapointValue
     */
    #[Optional('datapoint_value', union: DatapointValue::class)]
    public string|float|bool|array|null $datapointValue;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DatapointValueShape|null $datapointValue
     */
    public static function with(
        ?string $datapointName = null,
        string|float|bool|array|null $datapointValue = null
    ): self {
        $self = new self;

        null !== $datapointName && $self['datapointName'] = $datapointName;
        null !== $datapointValue && $self['datapointValue'] = $datapointValue;

        return $self;
    }

    /**
     * Name of the extracted data point.
     */
    public function withDatapointName(string $datapointName): self
    {
        $self = clone $this;
        $self['datapointName'] = $datapointName;

        return $self;
    }

    /**
     * Value of the extracted data point. Can be a primitive type, an array of primitives, or an array of objects when datapoint_list_type is 'object'.
     *
     * @param DatapointValueShape $datapointValue
     */
    public function withDatapointValue(
        string|float|bool|array $datapointValue
    ): self {
        $self = clone $this;
        $self['datapointValue'] = $datapointValue;

        return $self;
    }
}
