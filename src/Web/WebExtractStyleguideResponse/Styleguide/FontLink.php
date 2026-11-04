<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\FontLink\Face;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\FontLink\Type;

/**
 * @phpstan-import-type FaceShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\FontLink\Face
 *
 * @phpstan-type FontLinkShape = array{
 *   type: Type|value-of<Type>,
 *   category?: string|null,
 *   displayName?: string|null,
 *   faces?: list<Face|FaceShape>|null,
 *   files?: array<string,string>|null,
 * }
 */
final class FontLink implements BaseModel
{
    /** @use SdkModel<FontLinkShape> */
    use SdkModel;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Google Fonts category when type is google (e.g. sans-serif, serif, monospace, display, handwriting). Omitted for custom fonts when unknown.
     */
    #[Optional]
    public ?string $category;

    /**
     * Human-readable family name. For custom fonts, derived from the fontLinks key; for Google fonts, the canonical Google Fonts family name.
     */
    #[Optional]
    public ?string $displayName;

    /**
     * Discovered font faces, including style, weight, and distinct Unicode subsets.
     *
     * @var list<Face>|null $faces
     */
    #[Optional(list: Face::class)]
    public ?array $faces;

    /**
     * @deprecated
     *
     * Deprecated upright font lookup keyed by weight string. A variable font can map several standard weight keys to the same URL; faces retains its actual weight range.
     *
     * @var array<string,string>|null $files
     */
    #[Optional(map: 'string')]
    public ?array $files;

    /**
     * `new FontLink()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FontLink::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FontLink)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param list<Face|FaceShape>|null $faces
     * @param array<string,string>|null $files
     */
    public static function with(
        Type|string $type,
        ?string $category = null,
        ?string $displayName = null,
        ?array $faces = null,
        ?array $files = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $category && $self['category'] = $category;
        null !== $displayName && $self['displayName'] = $displayName;
        null !== $faces && $self['faces'] = $faces;
        null !== $files && $self['files'] = $files;

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
     * Human-readable family name. For custom fonts, derived from the fontLinks key; for Google fonts, the canonical Google Fonts family name.
     */
    public function withDisplayName(string $displayName): self
    {
        $self = clone $this;
        $self['displayName'] = $displayName;

        return $self;
    }

    /**
     * Discovered font faces, including style, weight, and distinct Unicode subsets.
     *
     * @param list<Face|FaceShape> $faces
     */
    public function withFaces(array $faces): self
    {
        $self = clone $this;
        $self['faces'] = $faces;

        return $self;
    }

    /**
     * Deprecated upright font lookup keyed by weight string. A variable font can map several standard weight keys to the same URL; faces retains its actual weight range.
     *
     * @param array<string,string> $files
     */
    public function withFiles(array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

        return $self;
    }
}
