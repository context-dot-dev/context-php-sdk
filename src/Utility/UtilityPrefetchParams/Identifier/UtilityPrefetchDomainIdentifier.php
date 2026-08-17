<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchParams\Identifier;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Prefetch by domain.
 *
 * @phpstan-type UtilityPrefetchDomainIdentifierShape = array{domain: string}
 */
final class UtilityPrefetchDomainIdentifier implements BaseModel
{
    /** @use SdkModel<UtilityPrefetchDomainIdentifierShape> */
    use SdkModel;

    /**
     * Domain name to prefetch data for.
     */
    #[Required]
    public string $domain;

    /**
     * `new UtilityPrefetchDomainIdentifier()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UtilityPrefetchDomainIdentifier::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UtilityPrefetchDomainIdentifier)->withDomain(...)
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
     * Domain name to prefetch data for.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }
}
