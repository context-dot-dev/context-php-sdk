<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Button\Link;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Button\Primary;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Button\Secondary;

/**
 * Button component styles.
 *
 * @phpstan-import-type LinkShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Button\Link
 * @phpstan-import-type PrimaryShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Button\Primary
 * @phpstan-import-type SecondaryShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Button\Secondary
 *
 * @phpstan-type ButtonShape = array{
 *   link?: null|Link|LinkShape,
 *   primary?: null|Primary|PrimaryShape,
 *   secondary?: null|Secondary|SecondaryShape,
 * }
 */
final class Button implements BaseModel
{
    /** @use SdkModel<ButtonShape> */
    use SdkModel;

    #[Optional]
    public ?Link $link;

    #[Optional]
    public ?Primary $primary;

    #[Optional]
    public ?Secondary $secondary;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Link|LinkShape|null $link
     * @param Primary|PrimaryShape|null $primary
     * @param Secondary|SecondaryShape|null $secondary
     */
    public static function with(
        Link|array|null $link = null,
        Primary|array|null $primary = null,
        Secondary|array|null $secondary = null,
    ): self {
        $self = new self;

        null !== $link && $self['link'] = $link;
        null !== $primary && $self['primary'] = $primary;
        null !== $secondary && $self['secondary'] = $secondary;

        return $self;
    }

    /**
     * @param Link|LinkShape $link
     */
    public function withLink(Link|array $link): self
    {
        $self = clone $this;
        $self['link'] = $link;

        return $self;
    }

    /**
     * @param Primary|PrimaryShape $primary
     */
    public function withPrimary(Primary|array $primary): self
    {
        $self = clone $this;
        $self['primary'] = $primary;

        return $self;
    }

    /**
     * @param Secondary|SecondaryShape $secondary
     */
    public function withSecondary(Secondary|array $secondary): self
    {
        $self = clone $this;
        $self['secondary'] = $secondary;

        return $self;
    }
}
