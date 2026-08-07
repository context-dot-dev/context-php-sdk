<?php

declare(strict_types=1);

namespace ContextDev\Batch\CrawlControls\Source;

use ContextDev\Batch\CrawlControls\Source\StartURL\Type;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * The crawl discovered pages by following links from one URL.
 *
 * @phpstan-type StartURLShape = array{type: Type|value-of<Type>, url: string}
 */
final class StartURL implements BaseModel
{
    /** @use SdkModel<StartURLShape> */
    use SdkModel;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Page the crawl started from.
     */
    #[Required]
    public string $url;

    /**
     * `new StartURL()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StartURL::with(type: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StartURL)->withType(...)->withURL(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(Type|string $type, string $url): self
    {
        $self = new self;

        $self['type'] = $type;
        $self['url'] = $url;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Page the crawl started from.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
