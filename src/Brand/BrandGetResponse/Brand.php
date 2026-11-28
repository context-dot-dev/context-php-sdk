<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse;

use ContextDev\Brand\BrandGetResponse\Brand\Address;
use ContextDev\Brand\BrandGetResponse\Brand\Backdrop;
use ContextDev\Brand\BrandGetResponse\Brand\Color;
use ContextDev\Brand\BrandGetResponse\Brand\Employees;
use ContextDev\Brand\BrandGetResponse\Brand\Industries;
use ContextDev\Brand\BrandGetResponse\Brand\Links;
use ContextDev\Brand\BrandGetResponse\Brand\Logo;
use ContextDev\Brand\BrandGetResponse\Brand\PrimaryLanguage;
use ContextDev\Brand\BrandGetResponse\Brand\Social;
use ContextDev\Brand\BrandGetResponse\Brand\Stock;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * The brand's identity, visual assets, and company details.
 *
 * @phpstan-import-type AddressShape from \ContextDev\Brand\BrandGetResponse\Brand\Address
 * @phpstan-import-type BackdropShape from \ContextDev\Brand\BrandGetResponse\Brand\Backdrop
 * @phpstan-import-type ColorShape from \ContextDev\Brand\BrandGetResponse\Brand\Color
 * @phpstan-import-type EmployeesShape from \ContextDev\Brand\BrandGetResponse\Brand\Employees
 * @phpstan-import-type IndustriesShape from \ContextDev\Brand\BrandGetResponse\Brand\Industries
 * @phpstan-import-type LinksShape from \ContextDev\Brand\BrandGetResponse\Brand\Links
 * @phpstan-import-type LogoShape from \ContextDev\Brand\BrandGetResponse\Brand\Logo
 * @phpstan-import-type SocialShape from \ContextDev\Brand\BrandGetResponse\Brand\Social
 * @phpstan-import-type StockShape from \ContextDev\Brand\BrandGetResponse\Brand\Stock
 *
 * @phpstan-type BrandShape = array{
 *   address?: null|Address|AddressShape,
 *   backdrops?: list<Backdrop|BackdropShape>|null,
 *   colors?: list<Color|ColorShape>|null,
 *   description?: string|null,
 *   domain?: string|null,
 *   email?: string|null,
 *   employees?: null|Employees|EmployeesShape,
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
     * Physical address of the brand. Omitted when unknown.
     */
    #[Optional]
    public ?Address $address;

    /**
     * Backdrop images for the brand, such as social profile banners.
     *
     * @var list<Backdrop>|null $backdrops
     */
    #[Optional(list: Backdrop::class)]
    public ?array $backdrops;

    /**
     * Brand colors from the website and logos.
     *
     * @var list<Color>|null $colors
     */
    #[Optional(list: Color::class)]
    public ?array $colors;

    /**
     * Short description of the brand.
     */
    #[Optional]
    public ?string $description;

    /**
     * Domain of the brand.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Contact email address for the company.
     */
    #[Optional]
    public ?string $email;

    /**
     * Employee headcount. Omitted when unknown.
     */
    #[Optional]
    public ?Employees $employees;

    /**
     * Industry classification of the brand.
     */
    #[Optional]
    public ?Industries $industries;

    /**
     * Whether the brand's content is not safe for work (NSFW).
     */
    #[Optional('is_nsfw')]
    public ?bool $isNsfw;

    /**
     * Key pages on the brand's website.
     */
    #[Optional]
    public ?Links $links;

    /**
     * Brand logos, most relevant first. An SVG is listed ahead of a raster logo of the same shape.
     *
     * @var list<Logo>|null $logos
     */
    #[Optional(list: Logo::class)]
    public ?array $logos;

    /**
     * Contact phone number for the company.
     */
    #[Optional]
    public ?string $phone;

    /**
     * Lowercase language name, such as `english`.
     *
     * @var value-of<PrimaryLanguage>|null $primaryLanguage
     */
    #[Optional('primary_language', enum: PrimaryLanguage::class, nullable: true)]
    public ?string $primaryLanguage;

    /**
     * Brand slogan or tagline.
     */
    #[Optional]
    public ?string $slogan;

    /**
     * Social media profiles of the brand.
     *
     * @var list<Social>|null $socials
     */
    #[Optional(list: Social::class)]
    public ?array $socials;

    /**
     * Stock listing. Omitted when the company is not publicly traded.
     */
    #[Optional]
    public ?Stock $stock;

    /**
     * Brand name.
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
     * @param Employees|EmployeesShape|null $employees
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
        Employees|array|null $employees = null,
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
        null !== $employees && $self['employees'] = $employees;
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
     * Physical address of the brand. Omitted when unknown.
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
     * Backdrop images for the brand, such as social profile banners.
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
     * Brand colors from the website and logos.
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
     * Short description of the brand.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Domain of the brand.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Contact email address for the company.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Employee headcount. Omitted when unknown.
     *
     * @param Employees|EmployeesShape $employees
     */
    public function withEmployees(Employees|array $employees): self
    {
        $self = clone $this;
        $self['employees'] = $employees;

        return $self;
    }

    /**
     * Industry classification of the brand.
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
     * Whether the brand's content is not safe for work (NSFW).
     */
    public function withIsNsfw(bool $isNsfw): self
    {
        $self = clone $this;
        $self['isNsfw'] = $isNsfw;

        return $self;
    }

    /**
     * Key pages on the brand's website.
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
     * Brand logos, most relevant first. An SVG is listed ahead of a raster logo of the same shape.
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
     * Contact phone number for the company.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }

    /**
     * Lowercase language name, such as `english`.
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
     * Brand slogan or tagline.
     */
    public function withSlogan(string $slogan): self
    {
        $self = clone $this;
        $self['slogan'] = $slogan;

        return $self;
    }

    /**
     * Social media profiles of the brand.
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
     * Stock listing. Omitted when the company is not publicly traded.
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
     * Brand name.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
