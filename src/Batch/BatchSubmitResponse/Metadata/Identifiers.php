<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse\Metadata;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Identifiers returned for the person.
 *
 * @phpstan-type IdentifiersShape = array{linkedinURL?: string|null}
 */
final class Identifiers implements BaseModel
{
    /** @use SdkModel<IdentifiersShape> */
    use SdkModel;

    /**
     * LinkedIn profile URL.
     */
    #[Optional('linkedinUrl')]
    public ?string $linkedinURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $linkedinURL = null): self
    {
        $self = new self;

        null !== $linkedinURL && $self['linkedinURL'] = $linkedinURL;

        return $self;
    }

    /**
     * LinkedIn profile URL.
     */
    public function withLinkedinURL(string $linkedinURL): self
    {
        $self = clone $this;
        $self['linkedinURL'] = $linkedinURL;

        return $self;
    }
}
