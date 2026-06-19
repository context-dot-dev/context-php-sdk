<?php

declare(strict_types=1);

namespace ContextDev\Utility;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Signal that you may fetch brand data for a particular domain soon to improve latency.
 *
 * @see ContextDev\Services\UtilityService::prefetch()
 *
 * @phpstan-type UtilityPrefetchParamsShape = array{
 *   domain: string, timeoutMs?: int|null
 * }
 */
final class UtilityPrefetchParams implements BaseModel
{
    /** @use SdkModel<UtilityPrefetchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Domain name to prefetch brand data for.
     */
    #[Required]
    public string $domain;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

    /**
     * `new UtilityPrefetchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UtilityPrefetchParams::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UtilityPrefetchParams)->withDomain(...)
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
    public static function with(string $domain, ?int $timeoutMs = null): self
    {
        $self = new self;

        $self['domain'] = $domain;

        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Domain name to prefetch brand data for.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
