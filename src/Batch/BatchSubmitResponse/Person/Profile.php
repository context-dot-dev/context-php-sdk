<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse\Person;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Core profile details.
 *
 * @phpstan-type ProfileShape = array{
 *   fullName?: string|null,
 *   headline?: string|null,
 *   location?: string|null,
 *   profilePictureURL?: string|null,
 *   summary?: string|null,
 * }
 */
final class Profile implements BaseModel
{
    /** @use SdkModel<ProfileShape> */
    use SdkModel;

    /**
     * Person's full name.
     */
    #[Optional]
    public ?string $fullName;

    /**
     * Short professional headline.
     */
    #[Optional]
    public ?string $headline;

    /**
     * Person's listed location.
     */
    #[Optional]
    public ?string $location;

    /**
     * Profile image URL.
     */
    #[Optional('profilePictureUrl')]
    public ?string $profilePictureURL;

    /**
     * Brief profile summary.
     */
    #[Optional]
    public ?string $summary;

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
        ?string $fullName = null,
        ?string $headline = null,
        ?string $location = null,
        ?string $profilePictureURL = null,
        ?string $summary = null,
    ): self {
        $self = new self;

        null !== $fullName && $self['fullName'] = $fullName;
        null !== $headline && $self['headline'] = $headline;
        null !== $location && $self['location'] = $location;
        null !== $profilePictureURL && $self['profilePictureURL'] = $profilePictureURL;
        null !== $summary && $self['summary'] = $summary;

        return $self;
    }

    /**
     * Person's full name.
     */
    public function withFullName(string $fullName): self
    {
        $self = clone $this;
        $self['fullName'] = $fullName;

        return $self;
    }

    /**
     * Short professional headline.
     */
    public function withHeadline(string $headline): self
    {
        $self = clone $this;
        $self['headline'] = $headline;

        return $self;
    }

    /**
     * Person's listed location.
     */
    public function withLocation(string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    /**
     * Profile image URL.
     */
    public function withProfilePictureURL(string $profilePictureURL): self
    {
        $self = clone $this;
        $self['profilePictureURL'] = $profilePictureURL;

        return $self;
    }

    /**
     * Brief profile summary.
     */
    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
