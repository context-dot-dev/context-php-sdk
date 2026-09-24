<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Fields produced by parseParams.rules, after shared content filters.
 *
 * @phpstan-type ParsedShape = array{
 *   data: array<string,mixed>|null, requested: bool, success: bool|null
 * }
 */
final class Parsed implements BaseModel
{
    /** @use SdkModel<ParsedShape> */
    use SdkModel;

    /** @var array<string,mixed>|null $data */
    #[Required(map: 'mixed')]
    public ?array $data;

    #[Required]
    public bool $requested;

    /**
     * True when retrieved, false when retrieval failed, and null when not requested.
     */
    #[Required]
    public ?bool $success;

    /**
     * `new Parsed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Parsed::with(data: ..., requested: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Parsed)->withData(...)->withRequested(...)->withSuccess(...)
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
     * @param array<string,mixed>|null $data
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
     * @param array<string,mixed>|null $data
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
