<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML\Options\Country;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML\Options\Pdf;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Options for HTML output.
 *
 * @phpstan-import-type PdfShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML\Options\Pdf
 *
 * @phpstan-type OptionsShape = array{
 *   country?: null|Country|value-of<Country>,
 *   excludeSelectors?: list<string>|null,
 *   includeSelectors?: list<string>|null,
 *   maxAgeMs?: int|null,
 *   pdf?: null|Pdf|PdfShape,
 *   settleAnimations?: bool|null,
 *   useMainContentOnly?: bool|null,
 *   waitForMs?: int|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Fetch from this country (ISO 3166-1 alpha-2).
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
     * Keep only elements matching these CSS selectors. Filtered pages ignore `maxAgeMs`.
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $includeSelectors;

    /**
     * Maximum cache age in milliseconds. Defaults to 3 days (259200000 ms). Maximum: 1 year (31536000000 ms). `0` fetches fresh.
     */
    #[Optional(nullable: true)]
    public ?int $maxAgeMs;

    /**
     * PDF parsing controls. Use start/end to limit text extraction and embedded-image detection/OCR to an inclusive 1-based page range.
     */
    #[Optional]
    public ?Pdf $pdf;

    /**
     * Wait for CSS animations to finish before extracting, on browser-rendered pages.
     */
    #[Optional]
    public ?bool $settleAnimations;

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
        ?array $includeSelectors = null,
        ?int $maxAgeMs = null,
        Pdf|array|null $pdf = null,
        ?bool $settleAnimations = null,
        ?bool $useMainContentOnly = null,
        ?int $waitForMs = null,
    ): self {
        $self = new self;

        null !== $country && $self['country'] = $country;
        null !== $excludeSelectors && $self['excludeSelectors'] = $excludeSelectors;
        null !== $includeSelectors && $self['includeSelectors'] = $includeSelectors;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $settleAnimations && $self['settleAnimations'] = $settleAnimations;
        null !== $useMainContentOnly && $self['useMainContentOnly'] = $useMainContentOnly;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;

        return $self;
    }

    /**
     * Fetch from this country (ISO 3166-1 alpha-2).
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
     * Keep only elements matching these CSS selectors. Filtered pages ignore `maxAgeMs`.
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
     * Maximum cache age in milliseconds. Defaults to 3 days (259200000 ms). Maximum: 1 year (31536000000 ms). `0` fetches fresh.
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
     * Wait for CSS animations to finish before extracting, on browser-rendered pages.
     */
    public function withSettleAnimations(bool $settleAnimations): self
    {
        $self = clone $this;
        $self['settleAnimations'] = $settleAnimations;

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
