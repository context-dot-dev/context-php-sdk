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
     * google-maps parses Google Maps business data into data.results. Accepts Maps place, search, and internal data URLs. Uses a US exit and English labels regardless of hl or Accept-Language. google-play parses a Play Store app into data: details, developer contact, ratings, price, permissions, and data safety. google-play-reviews returns the 200 newest reviews of the app, with developer replies, in data.reviews. Both Play parsers accept app details URLs (play.google.com/store/apps/details?id=…); hl and gl set the language and storefront, defaulting to en and us. app-store parses an App Store app into data: details, developer, ratings, price, version, and screenshots. app-store-reviews returns up to the 500 newest reviews in data.reviews. Both App Store parsers accept app URLs (apps.apple.com/us/app/…/id…); the country in the path sets the storefront, defaulting to us. emails accepts any page and returns its email addresses as data.emails ([{ email }]), read from mailto links, Cloudflare-protected addresses, and visible text. phone-numbers accepts any page and returns its valid phone numbers in E.164 as data.phone_numbers ([{ phone }]), read from tel links and visible text; numbers without a country code are read for the country of the site TLD, defaulting to US. links accepts any page and returns its unique http(s) links as data.links ([{ url, text }]), with absolute URLs; text falls back to aria-label or image alt and is null when a link has none. The emails parser reads the rendered page and respects content filters; the other prebuilt parsers read their data independently of DOM filters.
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
     * google-maps parses Google Maps business data into data.results. Accepts Maps place, search, and internal data URLs. Uses a US exit and English labels regardless of hl or Accept-Language. google-play parses a Play Store app into data: details, developer contact, ratings, price, permissions, and data safety. google-play-reviews returns the 200 newest reviews of the app, with developer replies, in data.reviews. Both Play parsers accept app details URLs (play.google.com/store/apps/details?id=…); hl and gl set the language and storefront, defaulting to en and us. app-store parses an App Store app into data: details, developer, ratings, price, version, and screenshots. app-store-reviews returns up to the 500 newest reviews in data.reviews. Both App Store parsers accept app URLs (apps.apple.com/us/app/…/id…); the country in the path sets the storefront, defaulting to us. emails accepts any page and returns its email addresses as data.emails ([{ email }]), read from mailto links, Cloudflare-protected addresses, and visible text. phone-numbers accepts any page and returns its valid phone numbers in E.164 as data.phone_numbers ([{ phone }]), read from tel links and visible text; numbers without a country code are read for the country of the site TLD, defaulting to US. links accepts any page and returns its unique http(s) links as data.links ([{ url, text }]), with absolute URLs; text falls back to aria-label or image alt and is null when a link has none. The emails parser reads the rendered page and respects content filters; the other prebuilt parsers read their data independently of DOM filters.
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
