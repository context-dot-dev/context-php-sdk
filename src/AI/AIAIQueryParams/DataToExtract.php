<?php

declare(strict_types=1);

namespace ContextDev\AI\AIAIQueryParams;

use ContextDev\AI\AIAIQueryParams\DataToExtract\DatapointListType;
use ContextDev\AI\AIAIQueryParams\DataToExtract\DatapointObjectSchema;
use ContextDev\AI\AIAIQueryParams\DataToExtract\DatapointType;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataToExtractShape = array{
 *   datapointDescription: string,
 *   datapointExample: string,
 *   datapointName: string,
 *   datapointType: DatapointType|value-of<DatapointType>,
 *   datapointListType?: null|DatapointListType|value-of<DatapointListType>,
 *   datapointObjectSchema?: array<string,DatapointObjectSchema|value-of<DatapointObjectSchema>>|null,
 * }
 */
final class DataToExtract implements BaseModel
{
    /** @use SdkModel<DataToExtractShape> */
    use SdkModel;

    /**
     * Description of what to extract.
     */
    #[Required('datapoint_description')]
    public string $datapointDescription;

    /**
     * Example of the expected value.
     */
    #[Required('datapoint_example')]
    public string $datapointExample;

    /**
     * Name of the data point to extract.
     */
    #[Required('datapoint_name')]
    public string $datapointName;

    /**
     * Type of the data point.
     *
     * @var value-of<DatapointType> $datapointType
     */
    #[Required('datapoint_type', enum: DatapointType::class)]
    public string $datapointType;

    /**
     * Type of items in the list when datapoint_type is 'list'. Defaults to 'string'. Use 'object' to extract an array of objects matching a schema.
     *
     * @var value-of<DatapointListType>|null $datapointListType
     */
    #[Optional('datapoint_list_type', enum: DatapointListType::class)]
    public ?string $datapointListType;

    /**
     * Schema definition for objects when datapoint_list_type is 'object'. Provide a map of field names to their scalar types.
     *
     * @var array<string,value-of<DatapointObjectSchema>>|null $datapointObjectSchema
     */
    #[Optional('datapoint_object_schema', map: DatapointObjectSchema::class)]
    public ?array $datapointObjectSchema;

    /**
     * `new DataToExtract()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DataToExtract::with(
     *   datapointDescription: ...,
     *   datapointExample: ...,
     *   datapointName: ...,
     *   datapointType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DataToExtract)
     *   ->withDatapointDescription(...)
     *   ->withDatapointExample(...)
     *   ->withDatapointName(...)
     *   ->withDatapointType(...)
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
     * @param DatapointType|value-of<DatapointType> $datapointType
     * @param DatapointListType|value-of<DatapointListType>|null $datapointListType
     * @param array<string,DatapointObjectSchema|value-of<DatapointObjectSchema>>|null $datapointObjectSchema
     */
    public static function with(
        string $datapointDescription,
        string $datapointExample,
        string $datapointName,
        DatapointType|string $datapointType,
        DatapointListType|string|null $datapointListType = null,
        ?array $datapointObjectSchema = null,
    ): self {
        $self = new self;

        $self['datapointDescription'] = $datapointDescription;
        $self['datapointExample'] = $datapointExample;
        $self['datapointName'] = $datapointName;
        $self['datapointType'] = $datapointType;

        null !== $datapointListType && $self['datapointListType'] = $datapointListType;
        null !== $datapointObjectSchema && $self['datapointObjectSchema'] = $datapointObjectSchema;

        return $self;
    }

    /**
     * Description of what to extract.
     */
    public function withDatapointDescription(string $datapointDescription): self
    {
        $self = clone $this;
        $self['datapointDescription'] = $datapointDescription;

        return $self;
    }

    /**
     * Example of the expected value.
     */
    public function withDatapointExample(string $datapointExample): self
    {
        $self = clone $this;
        $self['datapointExample'] = $datapointExample;

        return $self;
    }

    /**
     * Name of the data point to extract.
     */
    public function withDatapointName(string $datapointName): self
    {
        $self = clone $this;
        $self['datapointName'] = $datapointName;

        return $self;
    }

    /**
     * Type of the data point.
     *
     * @param DatapointType|value-of<DatapointType> $datapointType
     */
    public function withDatapointType(DatapointType|string $datapointType): self
    {
        $self = clone $this;
        $self['datapointType'] = $datapointType;

        return $self;
    }

    /**
     * Type of items in the list when datapoint_type is 'list'. Defaults to 'string'. Use 'object' to extract an array of objects matching a schema.
     *
     * @param DatapointListType|value-of<DatapointListType> $datapointListType
     */
    public function withDatapointListType(
        DatapointListType|string $datapointListType
    ): self {
        $self = clone $this;
        $self['datapointListType'] = $datapointListType;

        return $self;
    }

    /**
     * Schema definition for objects when datapoint_list_type is 'object'. Provide a map of field names to their scalar types.
     *
     * @param array<string,DatapointObjectSchema|value-of<DatapointObjectSchema>> $datapointObjectSchema
     */
    public function withDatapointObjectSchema(
        array $datapointObjectSchema
    ): self {
        $self = clone $this;
        $self['datapointObjectSchema'] = $datapointObjectSchema;

        return $self;
    }
}
