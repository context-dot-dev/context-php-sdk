<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\ParseParams\Rule;

/**
 * Required when formats.parse is true.
 *
 * @phpstan-import-type RuleVariants from \ContextDev\Web\WebScrapeParams\ParseParams\Rule
 * @phpstan-import-type RuleShape from \ContextDev\Web\WebScrapeParams\ParseParams\Rule
 *
 * @phpstan-type ParseParamsShape = array{rules: array<string,RuleShape>}
 */
final class ParseParams implements BaseModel
{
    /** @use SdkModel<ParseParamsShape> */
    use SdkModel;

    /**
     * Map field names to CSS selectors or rules. Missing items return null; missing lists return [].
     *
     * @var array<string,RuleVariants> $rules
     */
    #[Required(map: Rule::class)]
    public array $rules;

    /**
     * `new ParseParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParseParams::with(rules: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParseParams)->withRules(...)
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
     */
    public static function with(array $rules): self
    {
        $self = new self;

        $self['rules'] = $rules;

        return $self;
    }

    /**
     * Map field names to CSS selectors or rules. Missing items return null; missing lists return [].
     *
     * @param array<string,RuleShape> $rules
     */
    public function withRules(array $rules): self
    {
        $self = clone $this;
        $self['rules'] = $rules;

        return $self;
    }
}
