<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Page content as Markdown, after content filters.
 *
 * @phpstan-type MarkdownShape = array{
 *   data: string|null,
 *   requested: bool,
 *   success: bool|null,
 *   errorCode?: string|null,
 *   message?: string|null,
 * }
 */
final class Markdown implements BaseModel
{
    /** @use SdkModel<MarkdownShape> */
    use SdkModel;

    #[Required]
    public ?string $data;

    /**
     * Whether you requested this output in `formats`.
     */
    #[Required]
    public bool $requested;

    /**
     * `true` when the output succeeded, `false` when it failed, `null` when it was not requested.
     */
    #[Required]
    public ?bool $success;

    /**
     * Machine-readable error code. Present only when `success` is `false`.
     */
    #[Optional('error_code')]
    public ?string $errorCode;

    /**
     * Human-readable explanation of the error and how to resolve it.
     */
    #[Optional]
    public ?string $message;

    /**
     * `new Markdown()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Markdown::with(data: ..., requested: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Markdown)->withData(...)->withRequested(...)->withSuccess(...)
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
        ?bool $success,
        ?string $errorCode = null,
        ?string $message = null,
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['requested'] = $requested;
        $self['success'] = $success;

        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $message && $self['message'] = $message;

        return $self;
    }

    public function withData(?string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Whether you requested this output in `formats`.
     */
    public function withRequested(bool $requested): self
    {
        $self = clone $this;
        $self['requested'] = $requested;

        return $self;
    }

    /**
     * `true` when the output succeeded, `false` when it failed, `null` when it was not requested.
     */
    public function withSuccess(?bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Machine-readable error code. Present only when `success` is `false`.
     */
    public function withErrorCode(string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * Human-readable explanation of the error and how to resolve it.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
