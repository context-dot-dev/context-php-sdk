<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByEmailResponse;

use ContextDev\Brand\BrandGetByEmailResponse\Brand\Address;
use ContextDev\Brand\BrandGetByEmailResponse\Brand\Backdrop;
use ContextDev\Brand\BrandGetByEmailResponse\Brand\Color;
use ContextDev\Brand\BrandGetByEmailResponse\Brand\Industries;
use ContextDev\Brand\BrandGetByEmailResponse\Brand\Links;
use ContextDev\Brand\BrandGetByEmailResponse\Brand\Logo;
use ContextDev\Brand\BrandGetByEmailResponse\Brand\PrimaryLanguage;
use ContextDev\Brand\BrandGetByEmailResponse\Brand\Social;
use ContextDev\Brand\BrandGetByEmailResponse\Brand\Stock;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Detailed brand information.
 *
 * @phpstan-import-type AddressShape from \ContextDev\Brand\BrandGetByEmailResponse\Brand\Address
 * @phpstan-import-type BackdropShape from \ContextDev\Brand\BrandGetByEmailResponse\Brand\Backdrop
 * @phpstan-import-type ColorShape from \ContextDev\Brand\BrandGetByEmailResponse\Brand\Color
 * @phpstan-import-type IndustriesShape from \ContextDev\Brand\BrandGetByEmailResponse\Brand\Industries
 * @phpstan-import-type LinksShape from \ContextDev\Brand\BrandGetByEmailResponse\Brand\Links
 * @phpstan-import-type LogoShape from \ContextDev\Brand\BrandGetByEmailResponse\Brand\Logo
 * @phpstan-import-type SocialShape from \ContextDev\Brand\BrandGetByEmailResponse\Brand\Social
 * @phpstan-import-type StockShape from \ContextDev\Brand\BrandGetByEmailResponse\Brand\Stock
 *
 * @phpstan-type BrandShape = array{
 *   address?: null|Address|AddressShape,
 *   backdrops?: list<Backdrop|BackdropShape>|null,
 *   colors?: list<Color|ColorShape>|null,
 *   description?: string|null,
 *   domain?: string|null,
 *   email?: string|null,
 *   industries?: null|Industries|IndustriesShape,
 *   isNsfw?: bool|null,
 *   links?: null|Links|LinksShape,
 *   logos?: list<Logo|LogoShape>|null,
 *   phone?: string|null,
 *   primaryLanguage?: null|PrimaryLanguage|value-of<PrimaryLanguage>,
 *   slogan?: string|null,
 *   socials?: list<Social|SocialShape>|null,
 *   stock?: null|Stock|StockShape,
 *   title?: string|null,
 * }
 */
final class Brand implements BaseModel
{
    /** @use SdkModel<BrandShape> */
    use SdkModel;

    /**
     * Physical address of the brand.
     */
    #[Optional]
    public ?Address $address;

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
     * A brief description of the brand.
     */
    #[Optional]
    public ?string $description;

    /**
     * The domain name of the brand.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Company email address.
     */
    #[Optional]
    public ?string $email;

    /**
     * Industry classification information for the brand.
     */
    #[Optional]
    public ?Industries $industries;

    /**
     * Indicates whether the brand content is not safe for work (NSFW).
     */
    #[Optional('is_nsfw')]
    public ?bool $isNsfw;

    /**
     * Important website links for the brand.
     */
    #[Optional]
    public ?Links $links;

    /**
     * An array of logos associated with the brand.
     *
     * @var list<Logo>|null $logos
     */
    #[Optional(list: Logo::class)]
    public ?array $logos;

    /**
     * Company phone number.
     */
    #[Optional]
    public ?string $phone;

    /**
     * The primary language of the brand's website content. Detected from the HTML lang tag, page content analysis, or social media descriptions.
     *
     * @var value-of<PrimaryLanguage>|null $primaryLanguage
     */
    #[Optional('primary_language', enum: PrimaryLanguage::class, nullable: true)]
    public ?string $primaryLanguage;

    /**
     * The brand's slogan.
     */
    #[Optional]
    public ?string $slogan;

    /**
     * An array of social media links for the brand.
     *
     * @var list<Social>|null $socials
     */
    #[Optional(list: Social::class)]
    public ?array $socials;

    /**
     * Stock market information for this brand (will be null if not a publicly traded company).
     */
    #[Optional]
    public ?Stock $stock;

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
     * @param Address|AddressShape|null $address
     * @param list<Backdrop|BackdropShape>|null $backdrops
     * @param list<Color|ColorShape>|null $colors
     * @param Industries|IndustriesShape|null $industries
     * @param Links|LinksShape|null $links
     * @param list<Logo|LogoShape>|null $logos
     * @param PrimaryLanguage|value-of<PrimaryLanguage>|null $primaryLanguage
     * @param list<Social|SocialShape>|null $socials
     * @param Stock|StockShape|null $stock
     */
    public static function with(
        Address|array|null $address = null,
        ?array $backdrops = null,
        ?array $colors = null,
        ?string $description = null,
        ?string $domain = null,
        ?string $email = null,
        Industries|array|null $industries = null,
        ?bool $isNsfw = null,
        Links|array|null $links = null,
        ?array $logos = null,
        ?string $phone = null,
        PrimaryLanguage|string|null $primaryLanguage = null,
        ?string $slogan = null,
        ?array $socials = null,
        Stock|array|null $stock = null,
        ?string $title = null,
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $backdrops && $self['backdrops'] = $backdrops;
        null !== $colors && $self['colors'] = $colors;
        null !== $description && $self['description'] = $description;
        null !== $domain && $self['domain'] = $domain;
        null !== $email && $self['email'] = $email;
        null !== $industries && $self['industries'] = $industries;
        null !== $isNsfw && $self['isNsfw'] = $isNsfw;
        null !== $links && $self['links'] = $links;
        null !== $logos && $self['logos'] = $logos;
        null !== $phone && $self['phone'] = $phone;
        null !== $primaryLanguage && $self['primaryLanguage'] = $primaryLanguage;
        null !== $slogan && $self['slogan'] = $slogan;
        null !== $socials && $self['socials'] = $socials;
        null !== $stock && $self['stock'] = $stock;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    /**
     * Physical address of the brand.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(Address|array $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

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
     * A brief description of the brand.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

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
     * Company email address.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Industry classification information for the brand.
     *
     * @param Industries|IndustriesShape $industries
     */
    public function withIndustries(Industries|array $industries): self
    {
        $self = clone $this;
        $self['industries'] = $industries;

        return $self;
    }

    /**
     * Indicates whether the brand content is not safe for work (NSFW).
     */
    public function withIsNsfw(bool $isNsfw): self
    {
        $self = clone $this;
        $self['isNsfw'] = $isNsfw;

        return $self;
    }

    /**
     * Important website links for the brand.
     *
     * @param Links|LinksShape $links
     */
    public function withLinks(Links|array $links): self
    {
        $self = clone $this;
        $self['links'] = $links;

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
     * Company phone number.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }

    /**
     * The primary language of the brand's website content. Detected from the HTML lang tag, page content analysis, or social media descriptions.
     *
     * @param PrimaryLanguage|value-of<PrimaryLanguage>|null $primaryLanguage
     */
    public function withPrimaryLanguage(
        PrimaryLanguage|string|null $primaryLanguage
    ): self {
        $self = clone $this;
        $self['primaryLanguage'] = $primaryLanguage;

        return $self;
    }

    /**
     * The brand's slogan.
     */
    public function withSlogan(string $slogan): self
    {
        $self = clone $this;
        $self['slogan'] = $slogan;

        return $self;
    }

    /**
     * An array of social media links for the brand.
     *
     * @param list<Social|SocialShape> $socials
     */
    public function withSocials(array $socials): self
    {
        $self = clone $this;
        $self['socials'] = $socials;

        return $self;
    }

    /**
     * Stock market information for this brand (will be null if not a publicly traded company).
     *
     * @param Stock|StockShape $stock
     */
    public function withStock(Stock|array $stock): self
    {
        $self = clone $this;
        $self['stock'] = $stock;

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
