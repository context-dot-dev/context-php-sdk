<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * A page to scrape, with optional data for matching results.
 *
 * @phpstan-type URLShape = array{
 *   url: string, itemID?: string|null, meta?: array<string,mixed>|null
 * }
 */
final class URL implements BaseModel
{
    /** @use SdkModel<URLShape> */
    use SdkModel;

    /**
     * Page URL to scrape.
     */
    #[Required]
    public string $url;

    /**
     * Your ID for this page, returned with its result. The same URL can use different IDs.
     */
    #[Optional('itemId')]
    public ?string $itemID;

    /**
     * Custom JSON returned unchanged with this page result.
     *
     * @var array<string,mixed>|null $meta
     */
    #[Optional(map: 'mixed')]
    public ?array $meta;

    /**
     * `new URL()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * URL::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new URL)->withURL(...)
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
     *
     * @param array<string,mixed>|null $meta
     */
    public static function with(
        string $url,
        ?string $itemID = null,
        ?array $meta = null
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $itemID && $self['itemID'] = $itemID;
        null !== $meta && $self['meta'] = $meta;

        return $self;
    }

    /**
     * Page URL to scrape.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Your ID for this page, returned with its result. The same URL can use different IDs.
     */
    public function withItemID(string $itemID): self
    {
        $self = clone $this;
        $self['itemID'] = $itemID;

        return $self;
    }

    /**
     * Custom JSON returned unchanged with this page result.
     *
     * @param array<string,mixed> $meta
     */
    public function withMeta(array $meta): self
    {
        $self = clone $this;
        $self['meta'] = $meta;

        return $self;
    }
}
