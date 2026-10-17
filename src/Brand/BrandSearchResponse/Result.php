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
     * The brand's domain.
     */
    #[Required]
    public string $domain;

    /**
     * Logo link URL that serves the brand's logo, generated per request for the calling organization.
     */
    #[Required]
    public string $logo;

    /**
     * The brand's name. Empty string when unknown.
     */
    #[Required]
    public string $name;

    /**
     * The brand's country, when available, as an uppercase ISO 3166-1 alpha-2 code.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * The brand's description, when available.
     */
    #[Optional]
    public ?string $description;

    /**
     * The brand's primary language, when available.
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
     * The brand's domain.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Logo link URL that serves the brand's logo, generated per request for the calling organization.
     */
    public function withLogo(string $logo): self
    {
        $self = clone $this;
        $self['logo'] = $logo;

        return $self;
    }

    /**
     * The brand's name. Empty string when unknown.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The brand's country, when available, as an uppercase ISO 3166-1 alpha-2 code.
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
     * The brand's description, when available.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The brand's primary language, when available.
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
