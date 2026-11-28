<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * List a monitor's detected changes, newest first. Each change includes its full diff and evidence.
 *
 * @see ContextDev\Services\MonitorsService::listChanges()
 *
 * @phpstan-type MonitorListChangesParamsShape = array{
 *   cursor?: string|null,
 *   limit?: int|null,
 *   since?: \DateTimeInterface|null,
 *   tag?: string|null,
 *   until?: \DateTimeInterface|null,
 * }
 */
final class MonitorListChangesParams implements BaseModel
{
    /** @use SdkModel<MonitorListChangesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum number of changes to return per page. Defaults to 25.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Return only changes detected at or after this time.
     */
    #[Optional]
    public ?\DateTimeInterface $since;

    /**
     * Return only changes that have this tag.
     */
    #[Optional]
    public ?string $tag;

    /**
     * Return only changes detected at or before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $until;

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
        ?string $cursor = null,
        ?int $limit = null,
        ?\DateTimeInterface $since = null,
        ?string $tag = null,
        ?\DateTimeInterface $until = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $since && $self['since'] = $since;
        null !== $tag && $self['tag'] = $tag;
        null !== $until && $self['until'] = $until;

        return $self;
    }

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum number of changes to return per page. Defaults to 25.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Return only changes detected at or after this time.
     */
    public function withSince(\DateTimeInterface $since): self
    {
        $self = clone $this;
        $self['since'] = $since;

        return $self;
    }

    /**
     * Return only changes that have this tag.
     */
    public function withTag(string $tag): self
    {
        $self = clone $this;
        $self['tag'] = $tag;

        return $self;
    }

    /**
     * Return only changes detected at or before this time.
     */
    public function withUntil(\DateTimeInterface $until): self
    {
        $self = clone $this;
        $self['until'] = $until;

        return $self;
    }
}
