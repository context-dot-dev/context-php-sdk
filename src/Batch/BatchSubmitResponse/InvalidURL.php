<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvalidURLShape = array{reason: string, url: string}
 */
final class InvalidURL implements BaseModel
{
    /** @use SdkModel<InvalidURLShape> */
    use SdkModel;

    /**
     * Why it was rejected.
     */
    #[Required]
    public string $reason;

    /**
     * Rejected URL.
     */
    #[Required]
    public string $url;

    /**
     * `new InvalidURL()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvalidURL::with(reason: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvalidURL)->withReason(...)->withURL(...)
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
    public static function with(string $reason, string $url): self
    {
        $self = new self;

        $self['reason'] = $reason;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Why it was rejected.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Rejected URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
