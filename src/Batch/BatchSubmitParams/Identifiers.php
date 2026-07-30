<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Known identifiers for the person. At least one identifier is required.
 *
 * @phpstan-type IdentifiersShape = array{linkedinURL?: string|null}
 */
final class Identifiers implements BaseModel
{
    /** @use SdkModel<IdentifiersShape> */
    use SdkModel;

    /**
     * LinkedIn profile URL, e.g. https://www.linkedin.com/in/yahia-bakour/.
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
     * LinkedIn profile URL, e.g. https://www.linkedin.com/in/yahia-bakour/.
     */
    public function withLinkedinURL(string $linkedinURL): self
    {
        $self = clone $this;
        $self['linkedinURL'] = $linkedinURL;

        return $self;
    }
}
