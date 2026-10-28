<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams\Profile;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type NewProfileShape = array{
 *   identifier: string, password: string, type: 'new', description?: string|null
 * }
 */
final class NewProfile implements BaseModel
{
    /** @use SdkModel<NewProfileShape> */
    use SdkModel;

    /**
     * Sign in and create a browser profile.
     *
     * @var 'new' $type
     */
    #[Required]
    public string $type = 'new';

    /**
     * Username or email for the target website.
     */
    #[Required]
    public string $identifier;

    /**
     * Password used to sign in. It is never stored in the profile.
     */
    #[Required]
    public string $password;

    /**
     * Optional label shown when listing profiles with `GET /org/browser/profiles`.
     */
    #[Optional]
    public ?string $description;

    /**
     * `new NewProfile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewProfile::with(identifier: ..., password: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewProfile)->withIdentifier(...)->withPassword(...)
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
        string $identifier,
        string $password,
        ?string $description = null
    ): self {
        $self = new self;

        $self['identifier'] = $identifier;
        $self['password'] = $password;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * Username or email for the target website.
     */
    public function withIdentifier(string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * Password used to sign in. It is never stored in the profile.
     */
    public function withPassword(string $password): self
    {
        $self = clone $this;
        $self['password'] = $password;

        return $self;
    }

    /**
     * Sign in and create a browser profile.
     *
     * @param 'new' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Optional label shown when listing profiles with `GET /org/browser/profiles`.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
