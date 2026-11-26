<?php

declare(strict_types=1);

namespace ContextDev\Batch\CrawlControls\Exclude;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Product detail pages.
 *
 * @phpstan-type CrawlProductMatcherShape = array{kind: 'product'}
 */
final class CrawlProductMatcher implements BaseModel
{
    /** @use SdkModel<CrawlProductMatcherShape> */
    use SdkModel;

    /**
     * Match product detail pages.
     *
     * @var 'product' $kind
     */
    #[Required]
    public string $kind = 'product';

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }

    /**
     * Match product detail pages.
     *
     * @param 'product' $kind
     */
    public function withKind(string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }
}
