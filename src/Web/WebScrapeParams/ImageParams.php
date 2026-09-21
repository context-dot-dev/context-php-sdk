<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\ImageParams\Dedupe;
use ContextDev\Web\WebScrapeParams\ImageParams\Enrich;

/**
 * Image options. Requires formats.images: true.
 *
 * @phpstan-type ImageParamsShape = array{
 *   dedupe?: null|Dedupe|value-of<Dedupe>,
 *   enrich?: list<Enrich|value-of<Enrich>>|null,
 * }
 */
final class ImageParams implements BaseModel
{
    /** @use SdkModel<ImageParamsShape> */
    use SdkModel;

    /**
     * For visual duplicates, keep the largest image.
     *
     * @var value-of<Dedupe>|null $dedupe
     */
    #[Optional(enum: Dedupe::class)]
    public ?string $dedupe;

    /**
     * Add dimensions, a visual category, or a hosted file URL.
     *
     * @var list<value-of<Enrich>>|null $enrich
     */
    #[Optional(list: Enrich::class)]
    public ?array $enrich;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Dedupe|value-of<Dedupe>|null $dedupe
     * @param list<Enrich|value-of<Enrich>>|null $enrich
     */
    public static function with(
        Dedupe|string|null $dedupe = null,
        ?array $enrich = null
    ): self {
        $self = new self;

        null !== $dedupe && $self['dedupe'] = $dedupe;
        null !== $enrich && $self['enrich'] = $enrich;

        return $self;
    }

    /**
     * For visual duplicates, keep the largest image.
     *
     * @param Dedupe|value-of<Dedupe> $dedupe
     */
    public function withDedupe(Dedupe|string $dedupe): self
    {
        $self = clone $this;
        $self['dedupe'] = $dedupe;

        return $self;
    }

    /**
     * Add dimensions, a visual category, or a hosted file URL.
     *
     * @param list<Enrich|value-of<Enrich>> $enrich
     */
    public function withEnrich(array $enrich): self
    {
        $self = clone $this;
        $self['enrich'] = $enrich;

        return $self;
    }
}
