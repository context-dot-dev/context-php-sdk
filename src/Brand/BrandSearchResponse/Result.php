<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandSearchResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{domain: string, logo: string, name: string}
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
     */
    public static function with(
        string $domain,
        string $logo,
        string $name
    ): self {
        $self = new self;

        $self['domain'] = $domain;
        $self['logo'] = $logo;
        $self['name'] = $name;

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
}
