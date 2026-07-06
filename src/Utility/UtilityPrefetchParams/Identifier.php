<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Identifier of the brand to prefetch. Provide exactly one of domain or email.
 *
 * @phpstan-type IdentifierShape = array{domain?: string|null, email?: string|null}
 */
final class Identifier implements BaseModel
{
    /** @use SdkModel<IdentifierShape> */
    use SdkModel;

    /**
     * Domain name to prefetch brand data for.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Email address to prefetch brand data for. The domain will be extracted from the email. Free email providers (gmail.com, yahoo.com, etc.) and disposable email addresses are not allowed.
     */
    #[Optional]
    public ?string $email;

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
        ?string $domain = null,
        ?string $email = null
    ): self {
        $self = new self;

        null !== $domain && $self['domain'] = $domain;
        null !== $email && $self['email'] = $email;

        return $self;
    }

    /**
     * Domain name to prefetch brand data for.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Email address to prefetch brand data for. The domain will be extracted from the email. Free email providers (gmail.com, yahoo.com, etc.) and disposable email addresses are not allowed.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }
}
