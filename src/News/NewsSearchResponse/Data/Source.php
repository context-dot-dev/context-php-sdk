<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchResponse\Data;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * The publication that published the article.
 *
 * @phpstan-type SourceShape = array{direct: bool, domain: string, name: string}
 */
final class Source implements BaseModel
{
    /** @use SdkModel<SourceShape> */
    use SdkModel;

    /**
     * True when Context observed this article in the publisher-owned feed.
     */
    #[Required]
    public bool $direct;

    /**
     * Website domain of the publication.
     */
    #[Required]
    public string $domain;

    /**
     * Name of the publication, such as Reuters.
     */
    #[Required]
    public string $name;

    /**
     * `new Source()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Source::with(direct: ..., domain: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Source)->withDirect(...)->withDomain(...)->withName(...)
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
        bool $direct,
        string $domain,
        string $name
    ): self {
        $self = new self;

        $self['direct'] = $direct;
        $self['domain'] = $domain;
        $self['name'] = $name;

        return $self;
    }

    /**
     * True when Context observed this article in the publisher-owned feed.
     */
    public function withDirect(bool $direct): self
    {
        $self = clone $this;
        $self['direct'] = $direct;

        return $self;
    }

    /**
     * Website domain of the publication.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Name of the publication, such as Reuters.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
