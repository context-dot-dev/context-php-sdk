<?php

declare(strict_types=1);

namespace ContextDev\Browser\Profiles\ProfileListResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   id: string, createdAt: \DateTimeInterface, description: string|null
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Unique ID of the browser profile. Pass it as `sharedParams.profile.profileId` on `POST /web/scrape`.
     */
    #[Required]
    public string $id;

    /**
     * When the browser profile was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Label set when the profile was created. `null` when none was set.
     */
    #[Required]
    public ?string $description;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(id: ..., createdAt: ..., description: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withID(...)->withCreatedAt(...)->withDescription(...)
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
        string $id,
        \DateTimeInterface $createdAt,
        ?string $description
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Unique ID of the browser profile. Pass it as `sharedParams.profile.profileId` on `POST /web/scrape`.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * When the browser profile was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Label set when the profile was created. `null` when none was set.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
