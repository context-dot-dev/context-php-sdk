<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Schema and instructions for the `json` output. Required when `formats.json` is `true`, and allowed only then.
 *
 * @phpstan-type JsonParamsShape = array{
 *   schema: array<string,mixed>, instructions?: string|null
 * }
 */
final class JsonParams implements BaseModel
{
    /** @use SdkModel<JsonParamsShape> */
    use SdkModel;

    /**
     * JSON Schema for the object to extract, not an example object. Must describe a top-level object, up to 50 KB. Make fields optional or nullable when the page may not state them.
     *
     * @var array<string,mixed> $schema
     */
    #[Required(map: 'mixed')]
    public array $schema;

    /**
     * Extra guidance, such as which facts to prefer or how to read a field.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * `new JsonParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JsonParams::with(schema: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JsonParams)->withSchema(...)
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
     * @param array<string,mixed> $schema
     */
    public static function with(
        array $schema,
        ?string $instructions = null
    ): self {
        $self = new self;

        $self['schema'] = $schema;

        null !== $instructions && $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * JSON Schema for the object to extract, not an example object. Must describe a top-level object, up to 50 KB. Make fields optional or nullable when the page may not state them.
     *
     * @param array<string,mixed> $schema
     */
    public function withSchema(array $schema): self
    {
        $self = clone $this;
        $self['schema'] = $schema;

        return $self;
    }

    /**
     * Extra guidance, such as which facts to prefer or how to read a field.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }
}
