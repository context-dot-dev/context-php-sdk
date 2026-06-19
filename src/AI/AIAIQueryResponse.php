<?php

declare(strict_types=1);

namespace ContextDev\AI;

use ContextDev\AI\AIAIQueryResponse\DataExtracted;
use ContextDev\AI\AIAIQueryResponse\KeyMetadata;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DataExtractedShape from \ContextDev\AI\AIAIQueryResponse\DataExtracted
 * @phpstan-import-type KeyMetadataShape from \ContextDev\AI\AIAIQueryResponse\KeyMetadata
 *
 * @phpstan-type AIAIQueryResponseShape = array{
 *   dataExtracted?: list<DataExtracted|DataExtractedShape>|null,
 *   domain?: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   status?: string|null,
 *   urlsAnalyzed?: list<string>|null,
 * }
 */
final class AIAIQueryResponse implements BaseModel
{
    /** @use SdkModel<AIAIQueryResponseShape> */
    use SdkModel;

    /**
     * Array of extracted data points.
     *
     * @var list<DataExtracted>|null $dataExtracted
     */
    #[Optional('data_extracted', list: DataExtracted::class)]
    public ?array $dataExtracted;

    /**
     * The domain that was analyzed.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Status of the response, e.g., 'ok'.
     */
    #[Optional]
    public ?string $status;

    /**
     * List of URLs that were analyzed.
     *
     * @var list<string>|null $urlsAnalyzed
     */
    #[Optional('urls_analyzed', list: 'string')]
    public ?array $urlsAnalyzed;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<DataExtracted|DataExtractedShape>|null $dataExtracted
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     * @param list<string>|null $urlsAnalyzed
     */
    public static function with(
        ?array $dataExtracted = null,
        ?string $domain = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $status = null,
        ?array $urlsAnalyzed = null,
    ): self {
        $self = new self;

        null !== $dataExtracted && $self['dataExtracted'] = $dataExtracted;
        null !== $domain && $self['domain'] = $domain;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $status && $self['status'] = $status;
        null !== $urlsAnalyzed && $self['urlsAnalyzed'] = $urlsAnalyzed;

        return $self;
    }

    /**
     * Array of extracted data points.
     *
     * @param list<DataExtracted|DataExtractedShape> $dataExtracted
     */
    public function withDataExtracted(array $dataExtracted): self
    {
        $self = clone $this;
        $self['dataExtracted'] = $dataExtracted;

        return $self;
    }

    /**
     * The domain that was analyzed.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

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
     * List of URLs that were analyzed.
     *
     * @param list<string> $urlsAnalyzed
     */
    public function withURLsAnalyzed(array $urlsAnalyzed): self
    {
        $self = clone $this;
        $self['urlsAnalyzed'] = $urlsAnalyzed;

        return $self;
    }
}
