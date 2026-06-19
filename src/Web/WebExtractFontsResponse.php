<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractFontsResponse\Font;
use ContextDev\Web\WebExtractFontsResponse\FontLink;
use ContextDev\Web\WebExtractFontsResponse\KeyMetadata;

/**
 * @phpstan-import-type FontShape from \ContextDev\Web\WebExtractFontsResponse\Font
 * @phpstan-import-type FontLinkShape from \ContextDev\Web\WebExtractFontsResponse\FontLink
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebExtractFontsResponse\KeyMetadata
 *
 * @phpstan-type WebExtractFontsResponseShape = array{
 *   code: int,
 *   domain: string,
 *   fonts: list<Font|FontShape>,
 *   status: string,
 *   fontLinks?: array<string,FontLink|FontLinkShape>|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebExtractFontsResponse implements BaseModel
{
    /** @use SdkModel<WebExtractFontsResponseShape> */
    use SdkModel;

    /**
     * HTTP status code, e.g., 200.
     */
    #[Required]
    public int $code;

    /**
     * The normalized domain that was processed.
     */
    #[Required]
    public string $domain;

    /**
     * Array of font usage information.
     *
     * @var list<Font> $fonts
     */
    #[Required(list: Font::class)]
    public array $fonts;

    /**
     * Status of the response, e.g., 'ok'.
     */
    #[Required]
    public string $status;

    /**
     * Font assets keyed by family name as it appears in the fonts array (non-generic names only). Clients match entries in fonts to pick a file URL from files. Omitted when no families resolve to Google or custom @font-face URLs.
     *
     * @var array<string,FontLink>|null $fontLinks
     */
    #[Optional(map: FontLink::class)]
    public ?array $fontLinks;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebExtractFontsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebExtractFontsResponse::with(code: ..., domain: ..., fonts: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebExtractFontsResponse)
     *   ->withCode(...)
     *   ->withDomain(...)
     *   ->withFonts(...)
     *   ->withStatus(...)
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
     * @param list<Font|FontShape> $fonts
     * @param array<string,FontLink|FontLinkShape>|null $fontLinks
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        int $code,
        string $domain,
        array $fonts,
        string $status,
        ?array $fontLinks = null,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['domain'] = $domain;
        $self['fonts'] = $fonts;
        $self['status'] = $status;

        null !== $fontLinks && $self['fontLinks'] = $fontLinks;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * HTTP status code, e.g., 200.
     */
    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * The normalized domain that was processed.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Array of font usage information.
     *
     * @param list<Font|FontShape> $fonts
     */
    public function withFonts(array $fonts): self
    {
        $self = clone $this;
        $self['fonts'] = $fonts;

        return $self;
    }

    /**
     * Status of the response, e.g., 'ok'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Font assets keyed by family name as it appears in the fonts array (non-generic names only). Clients match entries in fonts to pick a file URL from files. Omitted when no families resolve to Google or custom @font-face URLs.
     *
     * @param array<string,FontLink|FontLinkShape> $fontLinks
     */
    public function withFontLinks(array $fontLinks): self
    {
        $self = clone $this;
        $self['fontLinks'] = $fontLinks;

        return $self;
    }

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }
}
