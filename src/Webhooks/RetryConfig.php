<?php

declare(strict_types=1);

namespace ContextDev\Webhooks;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Automatic retry settings. Pass `{}` for the default schedule.
 *
 * @phpstan-type RetryConfigShape = array{delaysSeconds?: list<int>|null}
 */
final class RetryConfig implements BaseModel
{
    /** @use SdkModel<RetryConfigShape> */
    use SdkModel;

    /**
     * Delay before each automatic retry, in seconds, totaling at most 72 hours. Pass `[]` to disable automatic retries.
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
     * Delay before each automatic retry, in seconds, totaling at most 72 hours. Pass `[]` to disable automatic retries.
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
