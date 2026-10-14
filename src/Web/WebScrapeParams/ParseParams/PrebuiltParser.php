<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ParseParams;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\ParseParams\PrebuiltParser\Parser;

/**
 * @phpstan-type PrebuiltParserShape = array{
 *   parser: Parser|value-of<Parser>, type: 'prebuilt'
 * }
 */
final class PrebuiltParser implements BaseModel
{
    /** @use SdkModel<PrebuiltParserShape> */
    use SdkModel;

    /**
     * Use a prebuilt parser instead of custom rules.
     *
     * @var 'prebuilt' $type
     */
    #[Required]
    public string $type = 'prebuilt';

    /**
     * Parse Google Maps business data into data.results. Accepts Maps place, search, and internal data URLs. Uses a US exit and English labels regardless of hl or Accept-Language, and reads Maps data independently of DOM filters.
     *
     * @var value-of<Parser> $parser
     */
    #[Required(enum: Parser::class)]
    public string $parser;

    /**
     * `new PrebuiltParser()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PrebuiltParser::with(parser: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PrebuiltParser)->withParser(...)
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
     * @param Parser|value-of<Parser> $parser
     */
    public static function with(Parser|string $parser): self
    {
        $self = new self;

        $self['parser'] = $parser;

        return $self;
    }

    /**
     * Parse Google Maps business data into data.results. Accepts Maps place, search, and internal data URLs. Uses a US exit and English labels regardless of hl or Accept-Language, and reads Maps data independently of DOM filters.
     *
     * @param Parser|value-of<Parser> $parser
     */
    public function withParser(Parser|string $parser): self
    {
        $self = clone $this;
        $self['parser'] = $parser;

        return $self;
    }

    /**
     * Use a prebuilt parser instead of custom rules.
     *
     * @param 'prebuilt' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
