<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\FontLink\Type;

/**
 * @phpstan-type FontLinkShape = array{
 *   files: array<string,string>,
 *   type: Type|value-of<Type>,
 *   category?: string|null,
 *   displayName?: string|null,
 * }
 */
final class FontLink implements BaseModel
{
    /** @use SdkModel<FontLinkShape> */
    use SdkModel;

    /**
     * Upright font files keyed by weight string (e.g. "400" for regular, "500", "700"). Values are absolute URLs.
     *
     * @var array<string,string> $files
     */
    #[Required(map: 'string')]
    public array $files;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Google Fonts category when type is google (e.g. sans-serif, serif, monospace, display, handwriting). Omitted for custom fonts when unknown.
     */
    #[Optional]
    public ?string $category;

    /**
     * Present when type is custom: human-readable name derived from the fontLinks key (strip build/hash suffixes, split camelCase / PascalCase, normalize separators). Google entries omit this.
     */
    #[Optional]
    public ?string $displayName;

    /**
     * `new FontLink()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FontLink::with(files: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FontLink)->withFiles(...)->withType(...)
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
     * @param array<string,string> $files
     * @param Type|value-of<Type> $type
     */
    public static function with(
        array $files,
        Type|string $type,
        ?string $category = null,
        ?string $displayName = null,
    ): self {
        $self = new self;

        $self['files'] = $files;
        $self['type'] = $type;

        null !== $category && $self['category'] = $category;
        null !== $displayName && $self['displayName'] = $displayName;

        return $self;
    }

    /**
     * Upright font files keyed by weight string (e.g. "400" for regular, "500", "700"). Values are absolute URLs.
     *
     * @param array<string,string> $files
     */
    public function withFiles(array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Google Fonts category when type is google (e.g. sans-serif, serif, monospace, display, handwriting). Omitted for custom fonts when unknown.
     */
    public function withCategory(string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Present when type is custom: human-readable name derived from the fontLinks key (strip build/hash suffixes, split camelCase / PascalCase, normalize separators). Google entries omit this.
     */
    public function withDisplayName(string $displayName): self
    {
        $self = clone $this;
        $self['displayName'] = $displayName;

        return $self;
    }
}
