<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeResponse\Product\Data;

/**
 * Product details found on the page.
 *
 * @phpstan-import-type DataShape from \ContextDev\Web\WebScrapeResponse\Product\Data
 *
 * @phpstan-type ProductShape = array{
 *   data: null|Data|DataShape, requested: bool, success: bool|null
 * }
 */
final class Product implements BaseModel
{
    /** @use SdkModel<ProductShape> */
    use SdkModel;

    #[Required]
    public ?Data $data;

    #[Required]
    public bool $requested;

    /**
     * True when retrieved, false when retrieval failed, and null when not requested.
     */
    #[Required]
    public ?bool $success;

    /**
     * `new Product()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Product::with(data: ..., requested: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Product)->withData(...)->withRequested(...)->withSuccess(...)
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
     * @param Data|DataShape|null $data
     */
    public static function with(
        Data|array|null $data,
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
     * @param Data|DataShape|null $data
     */
    public function withData(Data|array|null $data): self
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
