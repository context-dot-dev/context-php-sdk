<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result;

use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Parsed\Type;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Custom rules return fields after content filters; unmatched fields are null ([] for lists). The google-maps parser returns business records in data.results, and the google-play parser returns one app record as data, google-play-reviews returns data.reviews, app-store and app-store-reviews do the same for the App Store, emails, phone-numbers, and links return data.emails, data.phone_numbers, and data.links from the rendered page; the store and Maps parsers read their data directly, independently of DOM filters and other outputs.
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

    #[Required]
    public bool $requested;

    /**
     * `true` if returned, `false` if it failed, `null` if not requested.
     */
    #[Required]
    public ?bool $success;

    /**
     * The selected prebuilt parser name, or custom when type is omitted, custom rules are used, or parsing is not requested.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

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
     * The selected prebuilt parser name, or custom when type is omitted, custom rules are used, or parsing is not requested.
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
