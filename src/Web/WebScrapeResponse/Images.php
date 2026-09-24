<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeResponse\Images\Data;

/**
 * Images after content filters. Empty when none are found.
 *
 * @phpstan-import-type DataShape from \ContextDev\Web\WebScrapeResponse\Images\Data
 *
 * @phpstan-type ImagesShape = array{
 *   data: list<Data|DataShape>|null, requested: bool, success: bool|null
 * }
 */
final class Images implements BaseModel
{
    /** @use SdkModel<ImagesShape> */
    use SdkModel;

    /** @var list<Data>|null $data */
    #[Required(list: Data::class)]
    public ?array $data;

    #[Required]
    public bool $requested;

    /**
     * True when retrieved, false when retrieval failed, and null when not requested.
     */
    #[Required]
    public ?bool $success;

    /**
     * `new Images()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Images::with(data: ..., requested: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Images)->withData(...)->withRequested(...)->withSuccess(...)
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
     * @param list<Data|DataShape>|null $data
     */
    public static function with(
        ?array $data,
        bool $requested,
        ?bool $success
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['requested'] = $requested;
        $self['success'] = $success;

        return $self;
    }

    /**
     * @param list<Data|DataShape>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withRequested(bool $requested): self
    {
        $self = clone $this;
        $self['requested'] = $requested;

        return $self;
    }

    /**
     * True when retrieved, false when retrieval failed, and null when not requested.
     */
    public function withSuccess(?bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
