<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result;

use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Parsed\Type;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Fields extracted by `parseParams`. Custom rules return each field after content filters, with `null` when nothing matches (`[]` for `list` rules). Prebuilt parsers return the record or lists described under `parseParams.parser`.
 *
 * @phpstan-type ParsedShape = array{
 *   data: array<string,mixed>|null,
 *   requested: bool,
 *   success: bool|null,
 *   type: Type|value-of<Type>,
 *   errorCode?: string|null,
 *   message?: string|null,
 * }
 */
final class Parsed implements BaseModel
{
    /** @use SdkModel<ParsedShape> */
    use SdkModel;

    /** @var array<string,mixed>|null $data */
    #[Required(map: 'mixed')]
    public ?array $data;

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
     * Prebuilt parser that ran, or `custom` for custom rules or when `parse` was not requested.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

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
     * `new Parsed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Parsed::with(data: ..., requested: ..., success: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Parsed)->withData(...)->withRequested(...)->withSuccess(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        ?array $data,
        bool $requested,
        ?bool $success,
        Type|string $type,
        ?string $errorCode = null,
        ?string $message = null,
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['requested'] = $requested;
        $self['success'] = $success;
        $self['type'] = $type;

        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $message && $self['message'] = $message;

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
     * Prebuilt parser that ran, or `custom` for custom rules or when `parse` was not requested.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

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
