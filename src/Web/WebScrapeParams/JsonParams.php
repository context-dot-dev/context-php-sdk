<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Required when formats.json is true.
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
     * JSON Schema for the returned object. Must describe a top-level object; at most 50 KB serialized. Optional fields the page does not state are omitted, or null when their type allows null, while required non-nullable fields always receive a best-effort value, so prefer nullable or optional fields for data a page may omit. Zod users can pass the output of z.toJSONSchema().
     *
     * @var array<string,mixed> $schema
     */
    #[Required(map: 'mixed')]
    public array $schema;

    /**
     * Optional guidance on which facts to prioritize or how to interpret schema fields.
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
     * JSON Schema for the returned object. Must describe a top-level object; at most 50 KB serialized. Optional fields the page does not state are omitted, or null when their type allows null, while required non-nullable fields always receive a best-effort value, so prefer nullable or optional fields for data a page may omit. Zod users can pass the output of z.toJSONSchema().
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
     * Optional guidance on which facts to prioritize or how to interpret schema fields.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }
}
