<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse;

use ContextDev\Batch\BatchSubmitResponse\Metadata\Identifiers;
use ContextDev\Batch\BatchSubmitResponse\Metadata\SourcesAttempted;
use ContextDev\Batch\BatchSubmitResponse\Metadata\SourcesSucceeded;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Additional response details.
 *
 * @phpstan-import-type IdentifiersShape from \ContextDev\Batch\BatchSubmitResponse\Metadata\Identifiers
 *
 * @phpstan-type MetadataShape = array{
 *   identifiers: Identifiers|IdentifiersShape,
 *   sourcesAttempted: list<SourcesAttempted|value-of<SourcesAttempted>>,
 *   sourcesSucceeded: list<SourcesSucceeded|value-of<SourcesSucceeded>>,
 *   urlsAnalyzed: list<string>,
 *   personalWebsiteURL?: string|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    /**
     * Identifiers returned for the person.
     */
    #[Required]
    public Identifiers $identifiers;

    /**
     * Source categories checked.
     *
     * @var list<value-of<SourcesAttempted>> $sourcesAttempted
     */
    #[Required(list: SourcesAttempted::class)]
    public array $sourcesAttempted;

    /**
     * Source categories with data.
     *
     * @var list<value-of<SourcesSucceeded>> $sourcesSucceeded
     */
    #[Required(list: SourcesSucceeded::class)]
    public array $sourcesSucceeded;

    /**
     * URLs reviewed for this profile.
     *
     * @var list<string> $urlsAnalyzed
     */
    #[Required(list: 'string')]
    public array $urlsAnalyzed;

    /**
     * Personal website URL, when found.
     */
    #[Optional('personalWebsiteUrl')]
    public ?string $personalWebsiteURL;

    /**
     * `new Metadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Metadata::with(
     *   identifiers: ...,
     *   sourcesAttempted: ...,
     *   sourcesSucceeded: ...,
     *   urlsAnalyzed: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Metadata)
     *   ->withIdentifiers(...)
     *   ->withSourcesAttempted(...)
     *   ->withSourcesSucceeded(...)
     *   ->withURLsAnalyzed(...)
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
     * @param Identifiers|IdentifiersShape $identifiers
     * @param list<SourcesAttempted|value-of<SourcesAttempted>> $sourcesAttempted
     * @param list<SourcesSucceeded|value-of<SourcesSucceeded>> $sourcesSucceeded
     * @param list<string> $urlsAnalyzed
     */
    public static function with(
        Identifiers|array $identifiers,
        array $sourcesAttempted,
        array $sourcesSucceeded,
        array $urlsAnalyzed,
        ?string $personalWebsiteURL = null,
    ): self {
        $self = new self;

        $self['identifiers'] = $identifiers;
        $self['sourcesAttempted'] = $sourcesAttempted;
        $self['sourcesSucceeded'] = $sourcesSucceeded;
        $self['urlsAnalyzed'] = $urlsAnalyzed;

        null !== $personalWebsiteURL && $self['personalWebsiteURL'] = $personalWebsiteURL;

        return $self;
    }

    /**
     * Identifiers returned for the person.
     *
     * @param Identifiers|IdentifiersShape $identifiers
     */
    public function withIdentifiers(Identifiers|array $identifiers): self
    {
        $self = clone $this;
        $self['identifiers'] = $identifiers;

        return $self;
    }

    /**
     * Source categories checked.
     *
     * @param list<SourcesAttempted|value-of<SourcesAttempted>> $sourcesAttempted
     */
    public function withSourcesAttempted(array $sourcesAttempted): self
    {
        $self = clone $this;
        $self['sourcesAttempted'] = $sourcesAttempted;

        return $self;
    }

    /**
     * Source categories with data.
     *
     * @param list<SourcesSucceeded|value-of<SourcesSucceeded>> $sourcesSucceeded
     */
    public function withSourcesSucceeded(array $sourcesSucceeded): self
    {
        $self = clone $this;
        $self['sourcesSucceeded'] = $sourcesSucceeded;

        return $self;
    }

    /**
     * URLs reviewed for this profile.
     *
     * @param list<string> $urlsAnalyzed
     */
    public function withURLsAnalyzed(array $urlsAnalyzed): self
    {
        $self = clone $this;
        $self['urlsAnalyzed'] = $urlsAnalyzed;

        return $self;
    }

    /**
     * Personal website URL, when found.
     */
    public function withPersonalWebsiteURL(string $personalWebsiteURL): self
    {
        $self = clone $this;
        $self['personalWebsiteURL'] = $personalWebsiteURL;

        return $self;
    }
}
