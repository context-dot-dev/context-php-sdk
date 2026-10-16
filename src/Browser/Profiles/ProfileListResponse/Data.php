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
     * Profile ID to pass as `sharedParams.profile.profileId` on `/web/scrape`.
     */
    #[Required]
    public string $id;

    /**
     * When the profile was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The description supplied when the profile was created, or null.
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
     * Profile ID to pass as `sharedParams.profile.profileId` on `/web/scrape`.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * When the profile was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The description supplied when the profile was created, or null.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
