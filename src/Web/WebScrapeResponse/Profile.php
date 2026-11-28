<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Browser profile used for this scrape. `null` when no profile was requested.
 *
 * @phpstan-type ProfileShape = array{id: string}
 */
final class Profile implements BaseModel
{
    /** @use SdkModel<ProfileShape> */
    use SdkModel;

    /**
     * ID of the browser profile. After creating a profile, save it and pass it as `sharedParams.profile.profileId` with `type: "existing"`.
     */
    #[Required]
    public string $id;

    /**
     * `new Profile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Profile::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Profile)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    /**
     * ID of the browser profile. After creating a profile, save it and pass it as `sharedParams.profile.profileId` with `type: "existing"`.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
