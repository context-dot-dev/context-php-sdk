<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeResponse\Images\Data;

/**
 * Images after content filters. `[]` when none are found.
 *
 * @phpstan-import-type DataShape from \ContextDev\Web\WebScrapeResponse\Images\Data
 *
 * @phpstan-type ImagesShape = array{
 *   data: list<Data|DataShape>|null,
 *   requested: bool,
 *   success: bool|null,
 *   errorCode?: string|null,
 *   message?: string|null,
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
     * `true` if returned, `false` if it failed, `null` if not requested.
     */
    #[Required]
    public ?bool $success;

    /**
     * Why the output failed. Present only when `success` is `false`.
     */
    #[Optional('error_code')]
    public ?string $errorCode;

    /**
     * Explanation of the failure and possible next steps.
     */
    #[Optional]
    public ?string $message;

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
     * `true` if returned, `false` if it failed, `null` if not requested.
     */
    public function withSuccess(?bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Why the output failed. Present only when `success` is `false`.
     */
    public function withErrorCode(string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * Explanation of the failure and possible next steps.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
