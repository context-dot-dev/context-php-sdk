<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Search brands by name or domain and get back up to 10 lightweight matches (domain, name, logo), most popular first: by Tranco rank, then market cap for brands outside the Tranco list, with text relevance breaking ties. Matching is prefix-based with no typo tolerance, so it is suited to autocomplete. Only brands already in the Context.dev index are returned — use /brand/retrieve to fetch (and index) a specific domain. Free on Pro and Scale plans; costs 1 credit per request on the Free and Starter plans.
 *
 * @see ContextDev\Services\BrandService::search()
 *
 * @phpstan-type BrandSearchParamsShape = array{
 *   query: string, tags?: list<string>|null
 * }
 */
final class BrandSearchParams implements BaseModel
{
    /** @use SdkModel<BrandSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search term, matched against brand names and domains by prefix (e.g. 'nike', 'nike.com', 'nik').
     */
    #[Required]
    public string $query;

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new BrandSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandSearchParams)->withQuery(...)
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
     * @param list<string>|null $tags
     */
    public static function with(string $query, ?array $tags = null): self
    {
        $self = new self;

        $self['query'] = $query;

        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * Search term, matched against brand names and domains by prefix (e.g. 'nike', 'nike.com', 'nik').
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
