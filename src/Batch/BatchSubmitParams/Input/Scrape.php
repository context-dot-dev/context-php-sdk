<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Scrape a list of up to 100,000 URLs.
 *
 * @phpstan-import-type DataShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data
 *
 * @phpstan-type ScrapeShape = array{data: Data|DataShape, mode: 'scrape'}
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
     * Use the same formats and parameters as POST /web/scrape, replacing url with urls. Options apply to every page.
     */
    #[Required]
    public Data $data;

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
     * @param Data|DataShape $data
     */
    public static function with(Data|array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * Use the same formats and parameters as POST /web/scrape, replacing url with urls. Options apply to every page.
     *
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
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
