<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebAnswersResponse\KeyMetadata;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebAnswersResponse\KeyMetadata
 *
 * @phpstan-type WebAnswersResponseShape = array{
 *   jsonContent: array<string,mixed>,
 *   sources: list<string>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   partial?: bool|null,
 * }
 */
final class WebAnswersResponse implements BaseModel
{
    /** @use SdkModel<WebAnswersResponseShape> */
    use SdkModel;

    /**
     * The answer, in the shape requested by json_format.
     *
     * @var array<string,mixed> $jsonContent
     */
    #[Required('json_content', map: 'mixed')]
    public array $jsonContent;

    /**
     * URLs that supplied search results or readable page content, in first-seen order. Unreadable pages are excluded.
     *
     * @var list<string> $sources
     */
    #[Required(list: 'string')]
    public array $sources;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * True when the request deadline ended research and the answer uses the evidence collected so far.
     */
    #[Optional]
    public ?bool $partial;

    /**
     * `new WebAnswersResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebAnswersResponse::with(jsonContent: ..., sources: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebAnswersResponse)->withJsonContent(...)->withSources(...)
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
     * @param array<string,mixed> $jsonContent
     * @param list<string> $sources
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        array $jsonContent,
        array $sources,
        KeyMetadata|array|null $keyMetadata = null,
        ?bool $partial = null,
    ): self {
        $self = new self;

        $self['jsonContent'] = $jsonContent;
        $self['sources'] = $sources;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $partial && $self['partial'] = $partial;

        return $self;
    }

    /**
     * The answer, in the shape requested by json_format.
     *
     * @param array<string,mixed> $jsonContent
     */
    public function withJsonContent(array $jsonContent): self
    {
        $self = clone $this;
        $self['jsonContent'] = $jsonContent;

        return $self;
    }

    /**
     * URLs that supplied search results or readable page content, in first-seen order. Unreadable pages are excluded.
     *
     * @param list<string> $sources
     */
    public function withSources(array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

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
     * True when the request deadline ended research and the answer uses the evidence collected so far.
     */
    public function withPartial(bool $partial): self
    {
        $self = clone $this;
        $self['partial'] = $partial;

        return $self;
    }
}
