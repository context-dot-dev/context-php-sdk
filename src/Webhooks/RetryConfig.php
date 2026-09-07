<?php

declare(strict_types=1);

namespace ContextDev\Webhooks;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Opt into durable webhook delivery. An empty object uses the default retry schedule. Omit retry to preserve legacy delivery behavior. The policy is snapshotted for each event.
 *
 * @phpstan-type RetryConfigShape = array{delaysSeconds?: list<int>|null}
 */
final class RetryConfig implements BaseModel
{
    /** @use SdkModel<RetryConfigShape> */
    use SdkModel;

    /**
     * Wait in seconds after each failed attempt. The first attempt is immediate. At most 10 delays, each 1–86400 seconds, totaling at most 72 hours. Small jitter is added automatically. An empty array disables automatic retries; manual retries remain available.
     *
     * @var list<int>|null $delaysSeconds
     */
    #[Optional('delays_seconds', list: 'int')]
    public ?array $delaysSeconds;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<int>|null $delaysSeconds
     */
    public static function with(?array $delaysSeconds = null): self
    {
        $self = new self;

        null !== $delaysSeconds && $self['delaysSeconds'] = $delaysSeconds;

        return $self;
    }

    /**
     * Wait in seconds after each failed attempt. The first attempt is immediate. At most 10 delays, each 1–86400 seconds, totaling at most 72 hours. Small jitter is added automatically. An empty array disables automatic retries; manual retries remain available.
     *
     * @param list<int> $delaysSeconds
     */
    public function withDelaysSeconds(array $delaysSeconds): self
    {
        $self = clone $this;
        $self['delaysSeconds'] = $delaysSeconds;

        return $self;
    }
}
