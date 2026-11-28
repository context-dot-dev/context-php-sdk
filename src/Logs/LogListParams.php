<?php

declare(strict_types=1);

namespace ContextDev\Logs;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * List your organization's API requests, newest first. Filter by time, endpoint, API key, status, error code, tags, or text. Includes batch settlements and monitor runs.
 *
 * @see ContextDev\Services\LogsService::list()
 *
 * @phpstan-type LogListParamsShape = array{
 *   errorCode?: string|null,
 *   errorsOnly?: bool|null,
 *   from?: \DateTimeInterface|null,
 *   keyID?: string|null,
 *   limit?: int|null,
 *   page?: int|null,
 *   path?: string|null,
 *   search?: string|null,
 *   statusCode?: int|null,
 *   tags?: string|null,
 *   to?: \DateTimeInterface|null,
 * }
 */
final class LogListParams implements BaseModel
{
    /** @use SdkModel<LogListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by the `error_code` returned in the response.
     */
    #[Optional]
    public ?string $errorCode;

    /**
     * Return only requests that failed with a 4xx or 5xx status.
     */
    #[Optional]
    public ?bool $errorsOnly;

    /**
     * Return requests at or after this time. Defaults to 24 hours before `to`.
     */
    #[Optional]
    public ?\DateTimeInterface $from;

    /**
     * Filter by the ID of the API key that made the request.
     */
    #[Optional]
    public ?string $keyID;

    /**
     * Maximum number of log entries to return per page.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Page number, starting at 1.
     */
    #[Optional]
    public ?int $page;

    /**
     * Filter by endpoint path, with or without the `/v1` prefix.
     */
    #[Optional]
    public ?string $path;

    /**
     * Case-insensitive text to find in the request query or body, such as a domain.
     */
    #[Optional]
    public ?string $search;

    /**
     * Filter by exact HTTP status code.
     */
    #[Optional]
    public ?int $statusCode;

    /**
     * Comma-separated tags. Returns log entries that have any of them. Up to 20 tags of 1 to 50 characters each.
     */
    #[Optional]
    public ?string $tags;

    /**
     * Return requests at or before this time. Defaults to now.
     */
    #[Optional]
    public ?\DateTimeInterface $to;

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
        ?string $errorCode = null,
        ?bool $errorsOnly = null,
        ?\DateTimeInterface $from = null,
        ?string $keyID = null,
        ?int $limit = null,
        ?int $page = null,
        ?string $path = null,
        ?string $search = null,
        ?int $statusCode = null,
        ?string $tags = null,
        ?\DateTimeInterface $to = null,
    ): self {
        $self = new self;

        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorsOnly && $self['errorsOnly'] = $errorsOnly;
        null !== $from && $self['from'] = $from;
        null !== $keyID && $self['keyID'] = $keyID;
        null !== $limit && $self['limit'] = $limit;
        null !== $page && $self['page'] = $page;
        null !== $path && $self['path'] = $path;
        null !== $search && $self['search'] = $search;
        null !== $statusCode && $self['statusCode'] = $statusCode;
        null !== $tags && $self['tags'] = $tags;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    /**
     * Filter by the `error_code` returned in the response.
     */
    public function withErrorCode(string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * Return only requests that failed with a 4xx or 5xx status.
     */
    public function withErrorsOnly(bool $errorsOnly): self
    {
        $self = clone $this;
        $self['errorsOnly'] = $errorsOnly;

        return $self;
    }

    /**
     * Return requests at or after this time. Defaults to 24 hours before `to`.
     */
    public function withFrom(\DateTimeInterface $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Filter by the ID of the API key that made the request.
     */
    public function withKeyID(string $keyID): self
    {
        $self = clone $this;
        $self['keyID'] = $keyID;

        return $self;
    }

    /**
     * Maximum number of log entries to return per page.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Page number, starting at 1.
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Filter by endpoint path, with or without the `/v1` prefix.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Case-insensitive text to find in the request query or body, such as a domain.
     */
    public function withSearch(string $search): self
    {
        $self = clone $this;
        $self['search'] = $search;

        return $self;
    }

    /**
     * Filter by exact HTTP status code.
     */
    public function withStatusCode(int $statusCode): self
    {
        $self = clone $this;
        $self['statusCode'] = $statusCode;

        return $self;
    }

    /**
     * Comma-separated tags. Returns log entries that have any of them. Up to 20 tags of 1 to 50 characters each.
     */
    public function withTags(string $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Return requests at or before this time. Defaults to now.
     */
    public function withTo(\DateTimeInterface $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
