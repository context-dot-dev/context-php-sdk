<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * A page the batch could not fetch.
 *
 * @phpstan-type FailedPageShape = array{
 *   errorCode: string,
 *   message: string,
 *   status: 'error',
 *   url: string,
 *   itemID?: string|null,
 *   meta?: array<string,mixed>|null,
 * }
 */
final class FailedPage implements BaseModel
{
    /** @use SdkModel<FailedPageShape> */
    use SdkModel;

    /**
     * The page could not be scraped.
     *
     * @var 'error' $status
     */
    #[Required]
    public string $status = 'error';

    /**
     * Why the page failed.
     */
    #[Required('error_code')]
    public string $errorCode;

    /**
     * Human-readable failure detail.
     */
    #[Required]
    public string $message;

    /**
     * URL as submitted, or as discovered by the crawl.
     */
    #[Required]
    public string $url;

    /**
     * Caller-supplied identifier echoed from submission.
     */
    #[Optional('itemId')]
    public ?string $itemID;

    /**
     * Caller-supplied metadata echoed from submission.
     *
     * @var array<string,mixed>|null $meta
     */
    #[Optional(map: 'mixed')]
    public ?array $meta;

    /**
     * `new FailedPage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FailedPage::with(errorCode: ..., message: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FailedPage)->withErrorCode(...)->withMessage(...)->withURL(...)
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
        string $errorCode,
        string $message,
        string $url,
        ?string $itemID = null,
        ?array $meta = null,
    ): self {
        $self = new self;

        $self['errorCode'] = $errorCode;
        $self['message'] = $message;
        $self['url'] = $url;

        null !== $itemID && $self['itemID'] = $itemID;
        null !== $meta && $self['meta'] = $meta;

        return $self;
    }

    /**
     * Why the page failed.
     */
    public function withErrorCode(string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * Human-readable failure detail.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * The page could not be scraped.
     *
     * @param 'error' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * URL as submitted, or as discovered by the crawl.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Caller-supplied identifier echoed from submission.
     */
    public function withItemID(string $itemID): self
    {
        $self = clone $this;
        $self['itemID'] = $itemID;

        return $self;
    }

    /**
     * Caller-supplied metadata echoed from submission.
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
