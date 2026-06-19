<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractCompetitorsResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractCompetitorsResponse\Competitor\Confidence;

/**
 * @phpstan-type CompetitorShape = array{
 *   confidence: Confidence|value-of<Confidence>,
 *   description: string,
 *   domain: string,
 *   name: string,
 *   sourceURLs: list<string>,
 *   url: string,
 * }
 */
final class Competitor implements BaseModel
{
    /** @use SdkModel<CompetitorShape> */
    use SdkModel;

    /**
     * Confidence that this company is a direct competitor.
     *
     * @var value-of<Confidence> $confidence
     */
    #[Required(enum: Confidence::class)]
    public string $confidence;

    /**
     * Short description of the competitor.
     */
    #[Required]
    public string $description;

    /**
     * Competitor's normalized official domain.
     */
    #[Required]
    public string $domain;

    /**
     * Competitor company or product name.
     */
    #[Required]
    public string $name;

    /**
     * Search result URLs used as evidence for this competitor.
     *
     * @var list<string> $sourceURLs
     */
    #[Required('sourceUrls', list: 'string')]
    public array $sourceURLs;

    /**
     * Competitor website URL.
     */
    #[Required]
    public string $url;

    /**
     * `new Competitor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Competitor::with(
     *   confidence: ...,
     *   description: ...,
     *   domain: ...,
     *   name: ...,
     *   sourceURLs: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Competitor)
     *   ->withConfidence(...)
     *   ->withDescription(...)
     *   ->withDomain(...)
     *   ->withName(...)
     *   ->withSourceURLs(...)
     *   ->withURL(...)
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
     * @param Confidence|value-of<Confidence> $confidence
     * @param list<string> $sourceURLs
     */
    public static function with(
        Confidence|string $confidence,
        string $description,
        string $domain,
        string $name,
        array $sourceURLs,
        string $url,
    ): self {
        $self = new self;

        $self['confidence'] = $confidence;
        $self['description'] = $description;
        $self['domain'] = $domain;
        $self['name'] = $name;
        $self['sourceURLs'] = $sourceURLs;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Confidence that this company is a direct competitor.
     *
     * @param Confidence|value-of<Confidence> $confidence
     */
    public function withConfidence(Confidence|string $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Short description of the competitor.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Competitor's normalized official domain.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Competitor company or product name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Search result URLs used as evidence for this competitor.
     *
     * @param list<string> $sourceURLs
     */
    public function withSourceURLs(array $sourceURLs): self
    {
        $self = clone $this;
        $self['sourceURLs'] = $sourceURLs;

        return $self;
    }

    /**
     * Competitor website URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
