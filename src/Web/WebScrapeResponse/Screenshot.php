<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * An image data URL. Use directly as an image src.
 *
 * @phpstan-type ScreenshotShape = array{
 *   data: string|null, requested: bool, success: bool|null
 * }
 */
final class Screenshot implements BaseModel
{
    /** @use SdkModel<ScreenshotShape> */
    use SdkModel;

    #[Required]
    public ?string $data;

    #[Required]
    public bool $requested;

    /**
     * True when retrieved, false when retrieval failed, and null when not requested.
     */
    #[Required]
    public ?bool $success;

    /**
     * `new Screenshot()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Screenshot::with(data: ..., requested: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Screenshot)->withData(...)->withRequested(...)->withSuccess(...)
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
    public static function with(
        ?string $data,
        bool $requested,
        ?bool $success
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['requested'] = $requested;
        $self['success'] = $success;

        return $self;
    }

    public function withData(?string $data): self
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
