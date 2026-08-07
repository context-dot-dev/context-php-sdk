<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Scrape up to 25K URLs in one batch.
 *
 * @phpstan-import-type DataVariants from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data
 * @phpstan-import-type DataShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data
 *
 * @phpstan-type ScrapeShape = array{data: DataShape, mode: 'scrape'}
 */
final class Scrape implements BaseModel
{
    /** @use SdkModel<ScrapeShape> */
    use SdkModel;

    /**
     * Scrape the pages in `data.urls`.
     *
     * @var 'scrape' $mode
     */
    #[Required]
    public string $mode = 'scrape';

    /**
     * Pages to scrape and their output format.
     *
     * @var DataVariants $data
     */
    #[Required(union: Data::class)]
    public Markdown|HTML $data;

    /**
     * `new Scrape()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Scrape::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Scrape)->withData(...)
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
     * Pages to scrape and their output format.
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
     * Scrape the pages in `data.urls`.
     *
     * @param 'scrape' $mode
     */
    public function withMode(string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }
}
