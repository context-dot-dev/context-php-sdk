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
 *   requestID: string,
 *   status: Status|value-of<Status>,
 *   target: Target|TargetShape,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   partial?: bool|null,
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
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

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
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * True when the timeout ended processing and this response contains only usable results completed so far. Unfinished results are omitted.
     */
    #[Optional]
    public ?bool $partial;

    /**
     * `new WebExtractCompetitorsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebExtractCompetitorsResponse::with(
     *   competitors: ..., domain: ..., requestID: ..., status: ..., target: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebExtractCompetitorsResponse)
     *   ->withCompetitors(...)
     *   ->withDomain(...)
     *   ->withRequestID(...)
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
        string $requestID,
        Status|string $status,
        Target|array $target,
        KeyMetadata|array|null $keyMetadata = null,
        ?bool $partial = null,
    ): self {
        $self = new self;

        $self['competitors'] = $competitors;
        $self['domain'] = $domain;
        $self['requestID'] = $requestID;
        $self['status'] = $status;
        $self['target'] = $target;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $partial && $self['partial'] = $partial;

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
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

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
     * Credit usage, included whenever a valid API key is provided.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * True when the timeout ended processing and this response contains only usable results completed so far. Unfinished results are omitted.
     */
    public function withPartial(bool $partial): self
    {
        $self = clone $this;
        $self['partial'] = $partial;

        return $self;
    }
}
