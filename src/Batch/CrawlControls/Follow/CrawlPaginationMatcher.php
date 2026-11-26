<?php

declare(strict_types=1);

namespace ContextDev\Batch\CrawlControls\Follow;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Further pages of a paginated list, such as page 2 of a catalog.
 *
 * @phpstan-type CrawlPaginationMatcherShape = array{kind: 'pagination'}
 */
final class CrawlPaginationMatcher implements BaseModel
{
    /** @use SdkModel<CrawlPaginationMatcherShape> */
    use SdkModel;

    /**
     * Match the further pages of a paginated list.
     *
     * @var 'pagination' $kind
     */
    #[Required]
    public string $kind = 'pagination';

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
     * Match the further pages of a paginated list.
     *
     * @param 'pagination' $kind
     */
    public function withKind(string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }
}
