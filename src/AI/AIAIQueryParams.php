<?php

declare(strict_types=1);

namespace ContextDev\AI;

use ContextDev\AI\AIAIQueryParams\DataToExtract;
use ContextDev\AI\AIAIQueryParams\SpecificPages;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Use AI to extract specific data points from a brand's website. The AI will crawl the website and extract the requested information based on the provided data points.
 *
 * @see ContextDev\Services\AIService::aiQuery()
 *
 * @phpstan-import-type DataToExtractShape from \ContextDev\AI\AIAIQueryParams\DataToExtract
 * @phpstan-import-type SpecificPagesShape from \ContextDev\AI\AIAIQueryParams\SpecificPages
 *
 * @phpstan-type AIAIQueryParamsShape = array{
 *   dataToExtract: list<DataToExtract|DataToExtractShape>,
 *   domain: string,
 *   specificPages?: null|SpecificPages|SpecificPagesShape,
 *   timeoutMs?: int|null,
 * }
 */
final class AIAIQueryParams implements BaseModel
{
    /** @use SdkModel<AIAIQueryParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Array of data points to extract from the website.
     *
     * @var list<DataToExtract> $dataToExtract
     */
    #[Required('data_to_extract', list: DataToExtract::class)]
    public array $dataToExtract;

    /**
     * The domain name to analyze.
     */
    #[Required]
    public string $domain;

    /**
     * Optional object specifying which pages to analyze.
     */
    #[Optional('specific_pages')]
    public ?SpecificPages $specificPages;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

    /**
     * `new AIAIQueryParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AIAIQueryParams::with(dataToExtract: ..., domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AIAIQueryParams)->withDataToExtract(...)->withDomain(...)
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
     * @param list<DataToExtract|DataToExtractShape> $dataToExtract
     * @param SpecificPages|SpecificPagesShape|null $specificPages
     */
    public static function with(
        array $dataToExtract,
        string $domain,
        SpecificPages|array|null $specificPages = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['dataToExtract'] = $dataToExtract;
        $self['domain'] = $domain;

        null !== $specificPages && $self['specificPages'] = $specificPages;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Array of data points to extract from the website.
     *
     * @param list<DataToExtract|DataToExtractShape> $dataToExtract
     */
    public function withDataToExtract(array $dataToExtract): self
    {
        $self = clone $this;
        $self['dataToExtract'] = $dataToExtract;

        return $self;
    }

    /**
     * The domain name to analyze.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Optional object specifying which pages to analyze.
     *
     * @param SpecificPages|SpecificPagesShape $specificPages
     */
    public function withSpecificPages(SpecificPages|array $specificPages): self
    {
        $self = clone $this;
        $self['specificPages'] = $specificPages;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
