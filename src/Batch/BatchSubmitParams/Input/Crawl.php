<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Crawl pages starting from a URL or from a domain's sitemap.
 *
 * @phpstan-import-type DataVariants from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data
 * @phpstan-import-type DataShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data
 *
 * @phpstan-type CrawlShape = array{data: DataShape, mode: 'crawl'}
 */
final class Crawl implements BaseModel
{
    /** @use SdkModel<CrawlShape> */
    use SdkModel;

    /**
     * Discover and scrape pages from `data.source`.
     *
     * @var 'crawl' $mode
     */
    #[Required]
    public string $mode = 'crawl';

    /**
     * Crawl source and output format.
     *
     * @var DataVariants $data
     */
    #[Required(union: Data::class)]
    public Markdown|HTML $data;

    /**
     * `new Crawl()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Crawl::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Crawl)->withData(...)
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
     * @param DataShape $data
     */
    public static function with(Markdown|array|HTML $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * Crawl source and output format.
     *
     * @param DataShape $data
     */
    public function withData(Markdown|array|HTML $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Discover and scrape pages from `data.source`.
     *
     * @param 'crawl' $mode
     */
    public function withMode(string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }
}
