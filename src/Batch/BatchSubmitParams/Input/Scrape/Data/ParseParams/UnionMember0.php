<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ParseParams;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ParseParams\UnionMember0\Rule;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ParseParams\UnionMember0\Type;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type RuleVariants from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ParseParams\UnionMember0\Rule
 * @phpstan-import-type RuleShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ParseParams\UnionMember0\Rule
 *
 * @phpstan-type UnionMember0Shape = array{
 *   rules: array<string,RuleShape>, type?: null|Type|value-of<Type>
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<UnionMember0Shape> */
    use SdkModel;

    /**
     * Field names mapped to CSS selectors (`h1`, `a@href`) or rule objects. Max 100 fields, 5 levels.
     *
     * @var array<string,RuleVariants> $rules
     */
    #[Required(map: Rule::class)]
    public array $rules;

    /**
     * Extract fields using custom CSS rules. This is the default when type is omitted.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(rules: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember0)->withRules(...)
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
     * @param array<string,RuleShape> $rules
     * @param Type|value-of<Type>|null $type
     */
    public static function with(array $rules, Type|string|null $type = null): self
    {
        $self = new self;

        $self['rules'] = $rules;

        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Field names mapped to CSS selectors (`h1`, `a@href`) or rule objects. Max 100 fields, 5 levels.
     *
     * @param array<string,RuleShape> $rules
     */
    public function withRules(array $rules): self
    {
        $self = clone $this;
        $self['rules'] = $rules;

        return $self;
    }

    /**
     * Extract fields using custom CSS rules. This is the default when type is omitted.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
