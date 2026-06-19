<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractCompetitorsResponse\Competitor;
use ContextDev\Web\WebExtractCompetitorsResponse\KeyMetadata;
use ContextDev\Web\WebExtractCompetitorsResponse\Status;
use ContextDev\Web\WebExtractCompetitorsResponse\Target;

/**
 * @phpstan-import-type CompetitorShape from \ContextDev\Web\WebExtractCompetitorsResponse\Competitor
 * @phpstan-import-type TargetShape from \ContextDev\Web\WebExtractCompetitorsResponse\Target
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebExtractCompetitorsResponse\KeyMetadata
 *
 * @phpstan-type WebExtractCompetitorsResponseShape = array{
 *   competitors: list<Competitor|CompetitorShape>,
 *   domain: string,
 *   status: Status|value-of<Status>,
 *   target: Target|TargetShape,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebExtractCompetitorsResponse implements BaseModel
{
    /** @use SdkModel<WebExtractCompetitorsResponseShape> */
    use SdkModel;

    /**
     * Direct competitors ordered by relevance and confidence.
     *
     * @var list<Competitor> $competitors
     */
    #[Required(list: Competitor::class)]
    public array $competitors;

    /**
     * Normalized input domain.
     */
    #[Required]
    public string $domain;

    /**
     * Status of the response.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Target company profile inferred from the landing page.
     */
    #[Required]
    public Target $target;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebExtractCompetitorsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebExtractCompetitorsResponse::with(
     *   competitors: ..., domain: ..., status: ..., target: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebExtractCompetitorsResponse)
     *   ->withCompetitors(...)
     *   ->withDomain(...)
     *   ->withStatus(...)
     *   ->withTarget(...)
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
     * @param list<Competitor|CompetitorShape> $competitors
     * @param Status|value-of<Status> $status
     * @param Target|TargetShape $target
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        array $competitors,
        string $domain,
        Status|string $status,
        Target|array $target,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['competitors'] = $competitors;
        $self['domain'] = $domain;
        $self['status'] = $status;
        $self['target'] = $target;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Direct competitors ordered by relevance and confidence.
     *
     * @param list<Competitor|CompetitorShape> $competitors
     */
    public function withCompetitors(array $competitors): self
    {
        $self = clone $this;
        $self['competitors'] = $competitors;

        return $self;
    }

    /**
     * Normalized input domain.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Status of the response.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Target company profile inferred from the landing page.
     *
     * @param Target|TargetShape $target
     */
    public function withTarget(Target|array $target): self
    {
        $self = clone $this;
        $self['target'] = $target;

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
