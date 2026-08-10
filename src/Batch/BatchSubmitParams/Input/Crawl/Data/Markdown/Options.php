<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Options\Country;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Options\Pdf;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Options for Markdown output.
 *
 * @phpstan-import-type PdfShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Options\Pdf
 *
 * @phpstan-type OptionsShape = array{
 *   country?: null|Country|value-of<Country>,
 *   excludeSelectors?: list<string>|null,
 *   includeHTML?: bool|null,
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   includeSelectors?: list<string>|null,
 *   maxAgeMs?: int|null,
 *   pdf?: null|Pdf|PdfShape,
 *   settleAnimations?: bool|null,
 *   shortenBase64Images?: bool|null,
 *   useMainContentOnly?: bool|null,
 *   waitForMs?: int|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2).
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Remove elements matching these CSS selectors. Applied after `includeSelectors`, so an element matching both is removed.
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $excludeSelectors;

    /**
     * Also include each page's HTML in its result record, as an `html` field alongside the Markdown.
     */
    #[Optional]
    public ?bool $includeHTML;

    /**
     * Include image references in the Markdown.
     */
    #[Optional]
    public ?bool $includeImages;

    /**
     * Include links in the Markdown.
     */
    #[Optional]
    public ?bool $includeLinks;

    /**
     * Keep only the subtrees matching these CSS selectors. Filtered pages are always fetched fresh, ignoring `maxAgeMs`.
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $includeSelectors;

    /**
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Wait briefly for CSS and transition animations to settle before extraction, on pages that render in a browser.
     */
    #[Optional]
    public ?bool $settleAnimations;

    /**
     * Shorten inline base64 image data.
     */
    #[Optional]
    public ?bool $shortenBase64Images;

    /**
     * Return the main content without navigation or footers.
     */
    #[Optional]
    public ?bool $useMainContentOnly;

    /**
     * How long to wait after initial page load, in milliseconds. `0` waits 500 ms.
     */
    #[Optional]
    public ?int $waitForMs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Country|value-of<Country>|null $country
     * @param list<string>|null $excludeSelectors
     * @param list<string>|null $includeSelectors
     * @param Pdf|PdfShape|null $pdf
     */
    public static function with(
        Country|string|null $country = null,
        ?array $excludeSelectors = null,
        ?bool $includeHTML = null,
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        ?array $includeSelectors = null,
        ?int $maxAgeMs = null,
        Pdf|array|null $pdf = null,
        ?bool $settleAnimations = null,
        ?bool $shortenBase64Images = null,
        ?bool $useMainContentOnly = null,
        ?int $waitForMs = null,
    ): self {
        $self = new self;

        null !== $country && $self['country'] = $country;
        null !== $excludeSelectors && $self['excludeSelectors'] = $excludeSelectors;
        null !== $includeHTML && $self['includeHTML'] = $includeHTML;
        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $includeSelectors && $self['includeSelectors'] = $includeSelectors;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $settleAnimations && $self['settleAnimations'] = $settleAnimations;
        null !== $shortenBase64Images && $self['shortenBase64Images'] = $shortenBase64Images;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;

        return $self;
    }

    /**
     * Fetch the target page through a residential proxy in this country (ISO 3166-1 alpha-2).
     *
     * @param Country|value-of<Country> $country
     */
    public function withCountry(Country|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Remove elements matching these CSS selectors. Applied after `includeSelectors`, so an element matching both is removed.
     *
     * @param list<string>|null $excludeSelectors
     */
    public function withExcludeSelectors(?array $excludeSelectors): self
    {
        $self = clone $this;
        $self['excludeSelectors'] = $excludeSelectors;

        return $self;
    }

    /**
     * Also include each page's HTML in its result record, as an `html` field alongside the Markdown.
     */
    public function withIncludeHTML(bool $includeHTML): self
    {
        $self = clone $this;
        $self['includeHTML'] = $includeHTML;

        return $self;
    }

    /**
     * Include image references in the Markdown.
     */
    public function withIncludeImages(bool $includeImages): self
    {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    /**
     * Include links in the Markdown.
     */
    public function withIncludeLinks(bool $includeLinks): self
    {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * Keep only the subtrees matching these CSS selectors. Filtered pages are always fetched fresh, ignoring `maxAgeMs`.
     *
     * @param list<string>|null $includeSelectors
     */
    public function withIncludeSelectors(?array $includeSelectors): self
    {
        $self = clone $this;
        $self['includeSelectors'] = $includeSelectors;

        return $self;
    }

    /**
     * Return a cached result if a prior scrape for the same parameters exists and is younger than this many milliseconds. Defaults to 1 day (86400000 ms) when omitted. Max is 30 days (2592000000 ms). Set to 0 to always scrape fresh.
     */
    public function withMaxAgeMs(?int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
     *
     * @param Pdf|PdfShape $pdf
     */
    public function withPdf(Pdf|array $pdf): self
    {
        $self = clone $this;
        $self['pdf'] = $pdf;

        return $self;
    }

    /**
     * Wait briefly for CSS and transition animations to settle before extraction, on pages that render in a browser.
     */
    public function withSettleAnimations(bool $settleAnimations): self
    {
        $self = clone $this;
        $self['settleAnimations'] = $settleAnimations;

        return $self;
    }

    /**
     * Shorten inline base64 image data.
     */
    public function withShortenBase64Images(bool $shortenBase64Images): self
    {
        $self = clone $this;
        $self['shortenBase64Images'] = $shortenBase64Images;

        return $self;
    }

    /**
     * Return the main content without navigation or footers.
     */
    public function withUseMainContentOnly(bool $useMainContentOnly): self
    {
        $self = clone $this;
        $self['useMainContentOnly'] = $useMainContentOnly;

        return $self;
    }

    /**
     * How long to wait after initial page load, in milliseconds. `0` waits 500 ms.
     */
    public function withWaitForMs(int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }
}
