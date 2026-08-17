<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SearchBy\Entity;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Identify the company by website domain.
 *
 * @phpstan-type NewsSearchEntityByDomainShape = array{
 *   domain: string, type: 'domain'
 * }
 */
final class NewsSearchEntityByDomain implements BaseModel
{
    /** @use SdkModel<NewsSearchEntityByDomainShape> */
    use SdkModel;

    /** @var 'domain' $type */
    #[Required]
    public string $type = 'domain';

    /**
     * Company website domain, such as apple.com.
     */
    #[Required]
    public string $domain;

    /**
     * `new NewsSearchEntityByDomain()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewsSearchEntityByDomain::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewsSearchEntityByDomain)->withDomain(...)
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
    public static function with(string $domain): self
    {
        $self = new self;

        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Company website domain, such as apple.com.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * @param 'domain' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
