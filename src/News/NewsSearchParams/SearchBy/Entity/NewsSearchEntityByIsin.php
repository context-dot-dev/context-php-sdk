<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SearchBy\Entity;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Identify the company by International Securities Identification Number.
 *
 * @phpstan-type NewsSearchEntityByIsinShape = array{isin: string, type: 'isin'}
 */
final class NewsSearchEntityByIsin implements BaseModel
{
    /** @use SdkModel<NewsSearchEntityByIsinShape> */
    use SdkModel;

    /** @var 'isin' $type */
    #[Required]
    public string $type = 'isin';

    /**
     * International Securities Identification Number.
     */
    #[Required]
    public string $isin;

    /**
     * `new NewsSearchEntityByIsin()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewsSearchEntityByIsin::with(isin: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewsSearchEntityByIsin)->withIsin(...)
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
     */
    public static function with(string $isin): self
    {
        $self = new self;

        $self['isin'] = $isin;

        return $self;
    }

    /**
     * International Securities Identification Number.
     */
    public function withIsin(string $isin): self
    {
        $self = clone $this;
        $self['isin'] = $isin;

        return $self;
    }

    /**
     * @param 'isin' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
