<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetSimplifiedResponse;

use ContextDev\Brand\BrandGetSimplifiedResponse\Brand\Backdrop;
use ContextDev\Brand\BrandGetSimplifiedResponse\Brand\Color;
use ContextDev\Brand\BrandGetSimplifiedResponse\Brand\Logo;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Simplified brand information.
 *
 * @phpstan-import-type BackdropShape from \ContextDev\Brand\BrandGetSimplifiedResponse\Brand\Backdrop
 * @phpstan-import-type ColorShape from \ContextDev\Brand\BrandGetSimplifiedResponse\Brand\Color
 * @phpstan-import-type LogoShape from \ContextDev\Brand\BrandGetSimplifiedResponse\Brand\Logo
 *
 * @phpstan-type BrandShape = array{
 *   backdrops?: list<Backdrop|BackdropShape>|null,
 *   colors?: list<Color|ColorShape>|null,
 *   domain?: string|null,
 *   logos?: list<Logo|LogoShape>|null,
 *   title?: string|null,
 * }
 */
final class Brand implements BaseModel
{
    /** @use SdkModel<BrandShape> */
    use SdkModel;

    /**
     * An array of backdrop images for the brand.
     *
     * @var list<Backdrop>|null $backdrops
     */
    #[Optional(list: Backdrop::class)]
    public ?array $backdrops;

    /**
     * An array of brand colors.
     *
     * @var list<Color>|null $colors
     */
    #[Optional(list: Color::class)]
    public ?array $colors;

    /**
     * The domain name of the brand.
     */
    #[Optional]
    public ?string $domain;

    /**
     * An array of logos associated with the brand.
     *
     * @var list<Logo>|null $logos
     */
    #[Optional(list: Logo::class)]
    public ?array $logos;

    /**
     * The title or name of the brand.
     */
    #[Optional]
    public ?string $title;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Backdrop|BackdropShape>|null $backdrops
     * @param list<Color|ColorShape>|null $colors
     * @param list<Logo|LogoShape>|null $logos
     */
    public static function with(
        ?array $backdrops = null,
        ?array $colors = null,
        ?string $domain = null,
        ?array $logos = null,
        ?string $title = null,
    ): self {
        $self = new self;

        null !== $backdrops && $self['backdrops'] = $backdrops;
        null !== $colors && $self['colors'] = $colors;
        null !== $domain && $self['domain'] = $domain;
        null !== $logos && $self['logos'] = $logos;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    /**
     * An array of backdrop images for the brand.
     *
     * @param list<Backdrop|BackdropShape> $backdrops
     */
    public function withBackdrops(array $backdrops): self
    {
        $self = clone $this;
        $self['backdrops'] = $backdrops;

        return $self;
    }

    /**
     * An array of brand colors.
     *
     * @param list<Color|ColorShape> $colors
     */
    public function withColors(array $colors): self
    {
        $self = clone $this;
        $self['colors'] = $colors;

        return $self;
    }

    /**
     * The domain name of the brand.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * An array of logos associated with the brand.
     *
     * @param list<Logo|LogoShape> $logos
     */
    public function withLogos(array $logos): self
    {
        $self = clone $this;
        $self['logos'] = $logos;

        return $self;
    }

    /**
     * The title or name of the brand.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
