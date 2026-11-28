<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse\Brand;

use ContextDev\Brand\BrandGetResponse\Brand\Social\Type;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SocialShape = array{
 *   type?: null|Type|value-of<Type>, url?: string|null
 * }
 */
final class Social implements BaseModel
{
    /** @use SdkModel<SocialShape> */
    use SdkModel;

    /**
     * Social platform.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * URL of the brand's profile on that platform.
     */
    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        Type|string|null $type = null,
        ?string $url = null
    ): self {
        $self = new self;

        null !== $type && $self['type'] = $type;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Social platform.
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
     * URL of the brand's profile on that platform.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
