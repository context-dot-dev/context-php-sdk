<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings\H1;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings\H2;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings\H3;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings\H4;

/**
 * Heading styles.
 *
 * @phpstan-import-type H1Shape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings\H1
 * @phpstan-import-type H2Shape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings\H2
 * @phpstan-import-type H3Shape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings\H3
 * @phpstan-import-type H4Shape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings\H4
 *
 * @phpstan-type HeadingsShape = array{
 *   h1?: null|H1|H1Shape,
 *   h2?: null|H2|H2Shape,
 *   h3?: null|H3|H3Shape,
 *   h4?: null|H4|H4Shape,
 * }
 */
final class Headings implements BaseModel
{
    /** @use SdkModel<HeadingsShape> */
    use SdkModel;

    #[Optional]
    public ?H1 $h1;

    #[Optional]
    public ?H2 $h2;

    #[Optional]
    public ?H3 $h3;

    #[Optional]
    public ?H4 $h4;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param H1|H1Shape|null $h1
     * @param H2|H2Shape|null $h2
     * @param H3|H3Shape|null $h3
     * @param H4|H4Shape|null $h4
     */
    public static function with(
        H1|array|null $h1 = null,
        H2|array|null $h2 = null,
        H3|array|null $h3 = null,
        H4|array|null $h4 = null,
    ): self {
        $self = new self;

        null !== $h1 && $self['h1'] = $h1;
        null !== $h2 && $self['h2'] = $h2;
        null !== $h3 && $self['h3'] = $h3;
        null !== $h4 && $self['h4'] = $h4;

        return $self;
    }

    /**
     * @param H1|H1Shape $h1
     */
    public function withH1(H1|array $h1): self
    {
        $self = clone $this;
        $self['h1'] = $h1;

        return $self;
    }

    /**
     * @param H2|H2Shape $h2
     */
    public function withH2(H2|array $h2): self
    {
        $self = clone $this;
        $self['h2'] = $h2;

        return $self;
    }

    /**
     * @param H3|H3Shape $h3
     */
    public function withH3(H3|array $h3): self
    {
        $self = clone $this;
        $self['h3'] = $h3;

        return $self;
    }

    /**
     * @param H4|H4Shape $h4
     */
    public function withH4(H4|array $h4): self
    {
        $self = clone $this;
        $self['h4'] = $h4;

        return $self;
    }
}
