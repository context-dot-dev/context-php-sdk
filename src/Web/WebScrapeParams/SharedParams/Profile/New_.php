<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Profile;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type NewShape = array{
 *   identifier: string, password: string, type: 'new', description?: string|null
 * }
 */
final class New_ implements BaseModel
{
    /** @use SdkModel<NewShape> */
    use SdkModel;

    /**
     * Sign in and save a new browser profile.
     *
     * @var 'new' $type
     */
    #[Required]
    public string $type = 'new';

    /**
     * Username or email address for the website.
     */
    #[Required]
    public string $identifier;

    /**
     * Password for the website. Used to sign in and never stored.
     */
    #[Required]
    public string $password;

    /**
     * Label for the profile, shown by `GET /org/browser/profiles`.
     */
    #[Optional]
    public ?string $description;

    /**
     * `new New_()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * New_::with(identifier: ..., password: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new New_)->withIdentifier(...)->withPassword(...)
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
     * Username or email address for the website.
     */
    public function withIdentifier(string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * Password for the website. Used to sign in and never stored.
     */
    public function withPassword(string $password): self
    {
        $self = clone $this;
        $self['password'] = $password;

        return $self;
    }

    /**
     * Sign in and save a new browser profile.
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
     * Label for the profile, shown by `GET /org/browser/profiles`.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
