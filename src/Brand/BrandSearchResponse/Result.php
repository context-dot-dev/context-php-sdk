<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandSearchResponse;

use ContextDev\Brand\BrandSearchResponse\Result\Country;
use ContextDev\Brand\BrandSearchResponse\Result\Language;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{
 *   domain: string,
 *   logo: string,
 *   name: string,
 *   country?: null|Country|value-of<Country>,
 *   description?: string|null,
 *   language?: null|Language|value-of<Language>,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Domain of the brand.
     */
    #[Required]
    public string $domain;

    /**
     * Logo Link URL that serves the brand's logo with your organization's client ID. Use it directly as an image source.
     */
    #[Required]
    public string $logo;

    /**
     * Name of the brand. Empty string when unknown.
     */
    #[Required]
    public string $name;

    /**
     * Country of the brand, as an uppercase ISO 3166-1 alpha-2 code. Omitted when unknown.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Short description of the brand. Omitted when unknown.
     */
    #[Optional]
    public ?string $description;

    /**
     * Primary language of the brand. Omitted when unknown.
     *
     * @var value-of<Language>|null $language
     */
    #[Optional(enum: Language::class)]
    public ?string $language;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(domain: ..., logo: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)->withDomain(...)->withLogo(...)->withName(...)
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
     * @param Country|value-of<Country>|null $country
     * @param Language|value-of<Language>|null $language
     */
    public static function with(
        string $domain,
        string $logo,
        string $name,
        Country|string|null $country = null,
        ?string $description = null,
        Language|string|null $language = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;
        $self['logo'] = $logo;
        $self['name'] = $name;

        null !== $country && $self['country'] = $country;
        null !== $description && $self['description'] = $description;
        null !== $language && $self['language'] = $language;

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
     * Logo Link URL that serves the brand's logo with your organization's client ID. Use it directly as an image source.
     */
    public function withLogo(string $logo): self
    {
        $self = clone $this;
        $self['logo'] = $logo;

        return $self;
    }

    /**
     * Name of the brand. Empty string when unknown.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Country of the brand, as an uppercase ISO 3166-1 alpha-2 code. Omitted when unknown.
     *
     * @param Country|value-of<Country> $country
     */
    public function withCountry(Country|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Short description of the brand. Omitted when unknown.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Primary language of the brand. Omitted when unknown.
     *
     * @param Language|value-of<Language> $language
     */
    public function withLanguage(Language|string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }
}
