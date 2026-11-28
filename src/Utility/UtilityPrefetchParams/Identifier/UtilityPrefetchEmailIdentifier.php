<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchParams\Identifier;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Prefetch by work email. Context.dev uses the email's domain.
 *
 * @phpstan-type UtilityPrefetchEmailIdentifierShape = array{email: string}
 */
final class UtilityPrefetchEmailIdentifier implements BaseModel
{
    /** @use SdkModel<UtilityPrefetchEmailIdentifierShape> */
    use SdkModel;

    /**
     * Work email whose domain to prefetch. Free email providers such as `gmail.com` and disposable addresses are rejected with 422.
     */
    #[Required]
    public string $email;

    /**
     * `new UtilityPrefetchEmailIdentifier()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UtilityPrefetchEmailIdentifier::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UtilityPrefetchEmailIdentifier)->withEmail(...)
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
    public static function with(string $email): self
    {
        $self = new self;

        $self['email'] = $email;

        return $self;
    }

    /**
     * Work email whose domain to prefetch. Free email providers such as `gmail.com` and disposable addresses are rejected with 422.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }
}
