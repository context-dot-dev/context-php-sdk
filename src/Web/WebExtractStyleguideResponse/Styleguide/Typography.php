<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\P;

/**
 * Typography styles used on the website.
 *
 * @phpstan-import-type HeadingsShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings
 * @phpstan-import-type PShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\P
 *
 * @phpstan-type TypographyShape = array{
 *   headings: Headings|HeadingsShape, p?: null|P|PShape
 * }
 */
final class Typography implements BaseModel
{
    /** @use SdkModel<TypographyShape> */
    use SdkModel;

    /**
     * Heading styles.
     */
    #[Required]
    public Headings $headings;

    #[Optional]
    public ?P $p;

    /**
     * `new Typography()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Typography::with(headings: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Typography)->withHeadings(...)
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
     * @param Headings|HeadingsShape $headings
     * @param P|PShape|null $p
     */
    public static function with(
        Headings|array $headings,
        P|array|null $p = null
    ): self {
        $self = new self;

        $self['headings'] = $headings;

        null !== $p && $self['p'] = $p;

        return $self;
    }

    /**
     * Heading styles.
     *
     * @param Headings|HeadingsShape $headings
     */
    public function withHeadings(Headings|array $headings): self
    {
        $self = clone $this;
        $self['headings'] = $headings;

        return $self;
    }

    /**
     * @param P|PShape $p
     */
    public function withP(P|array $p): self
    {
        $self = clone $this;
        $self['p'] = $p;

        return $self;
    }
}
