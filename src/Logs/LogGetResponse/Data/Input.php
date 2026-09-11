<?php

declare(strict_types=1);

namespace ContextDev\Logs\LogGetResponse\Data;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * What was sent with the request.
 *
 * @phpstan-type InputShape = array{query: array<string,mixed>, body?: mixed}
 */
final class Input implements BaseModel
{
    /** @use SdkModel<InputShape> */
    use SdkModel;

    /**
     * Query parameters as sent.
     *
     * @var array<string,mixed> $query
     */
    #[Required(map: 'mixed')]
    public array $query;

    /**
     * Request body with credentials and uploaded content redacted.
     */
    #[Optional]
    public mixed $body;

    /**
     * `new Input()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Input::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Input)->withQuery(...)
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
     * @param array<string,mixed> $query
     */
    public static function with(array $query, mixed $body = null): self
    {
        $self = new self;

        $self['query'] = $query;

        null !== $body && $self['body'] = $body;

        return $self;
    }

    /**
     * Query parameters as sent.
     *
     * @param array<string,mixed> $query
     */
    public function withQuery(array $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Request body with credentials and uploaded content redacted.
     */
    public function withBody(mixed $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }
}
