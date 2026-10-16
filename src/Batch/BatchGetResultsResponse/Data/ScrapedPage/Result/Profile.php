<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Authenticated browser profile used for this scrape, or null when no profile was requested. New and existing profile requests both return the profile ID.
 *
 * @phpstan-type ProfileShape = array{id: string}
 */
final class Profile implements BaseModel
{
    /** @use SdkModel<ProfileShape> */
    use SdkModel;

    /**
     * Save this ID after creating a profile, then reuse it as sharedParams.profile.profileId with type "existing".
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
     * Save this ID after creating a profile, then reuse it as sharedParams.profile.profileId with type "existing".
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
