<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExistingShape = array{profileID: string, type: 'existing'}
 */
final class Existing implements BaseModel
{
    /** @use SdkModel<ExistingShape> */
    use SdkModel;

    /**
     * Reuse a saved browser profile.
     *
     * @var 'existing' $type
     */
    #[Required]
    public string $type = 'existing';

    /**
     * The ID returned in profile.id by an earlier scrape.
     */
    #[Required('profileId')]
    public string $profileID;

    /**
     * `new Existing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Existing::with(profileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Existing)->withProfileID(...)
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
    public static function with(string $profileID): self
    {
        $self = new self;

        $self['profileID'] = $profileID;

        return $self;
    }

    /**
     * The ID returned in profile.id by an earlier scrape.
     */
    public function withProfileID(string $profileID): self
    {
        $self = clone $this;
        $self['profileID'] = $profileID;

        return $self;
    }

    /**
     * Reuse a saved browser profile.
     *
     * @param 'existing' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
