<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ParseParams\Rule;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\ParseParams\Rule\UnionMember1\Output;
use ContextDev\Web\WebScrapeParams\ParseParams\Rule\UnionMember1\Type;

/**
 * @phpstan-import-type OutputVariants from \ContextDev\Web\WebScrapeParams\ParseParams\Rule\UnionMember1\Output
 * @phpstan-import-type OutputShape from \ContextDev\Web\WebScrapeParams\ParseParams\Rule\UnionMember1\Output
 *
 * @phpstan-type UnionMember1Shape = array{
 *   selector: string, output?: OutputShape|null, type?: null|Type|value-of<Type>
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
    use SdkModel;

    #[Required]
    public string $selector;

    /** @var OutputVariants|null $output */
    #[Optional(union: Output::class)]
    public mixed $output;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new UnionMember1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember1::with(selector: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember1)->withSelector(...)
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
     * @param OutputShape|null $output
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $selector,
        mixed $output = null,
        Type|string|null $type = null
    ): self {
        $self = new self;

        $self['selector'] = $selector;

        null !== $output && $self['output'] = $output;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }

    /**
     * @param OutputShape $output
     */
    public function withOutput(mixed $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

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
}
