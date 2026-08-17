<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchParams\FilterBy\ArticleLanguage;
use ContextDev\News\NewsSearchParams\FilterBy\ArticleType;
use ContextDev\News\NewsSearchParams\FilterBy\Date;
use ContextDev\News\NewsSearchParams\FilterBy\SourceCountry;

/**
 * Optional result filters.
 *
 * @phpstan-import-type DateShape from \ContextDev\News\NewsSearchParams\FilterBy\Date
 *
 * @phpstan-type FilterByShape = array{
 *   articleLanguage?: list<ArticleLanguage|value-of<ArticleLanguage>>|null,
 *   articleType?: list<ArticleType|value-of<ArticleType>>|null,
 *   date?: null|Date|DateShape,
 *   sourceCountry?: list<SourceCountry|value-of<SourceCountry>>|null,
 *   sourceDomain?: list<string>|null,
 * }
 */
final class FilterBy implements BaseModel
{
    /** @use SdkModel<FilterByShape> */
    use SdkModel;

    /**
     * Article languages to include. Up to 3.
     *
     * @var list<value-of<ArticleLanguage>>|null $articleLanguage
     */
    #[Optional(list: ArticleLanguage::class)]
    public ?array $articleLanguage;

    /**
     * Article types to include. Up to 3.
     *
     * @var list<value-of<ArticleType>>|null $articleType
     */
    #[Optional(list: ArticleType::class)]
    public ?array $articleType;

    /**
     * Published-at window in epoch milliseconds.
     */
    #[Optional]
    public ?Date $date;

    /**
     * Publisher countries to include, as lowercase ISO 3166-1 alpha-2 codes. Up to 3.
     *
     * @var list<value-of<SourceCountry>>|null $sourceCountry
     */
    #[Optional(list: SourceCountry::class)]
    public ?array $sourceCountry;

    /**
     * Publisher domains to include. Up to 3.
     *
     * @var list<string>|null $sourceDomain
     */
    #[Optional(list: 'string')]
    public ?array $sourceDomain;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<ArticleLanguage|value-of<ArticleLanguage>>|null $articleLanguage
     * @param list<ArticleType|value-of<ArticleType>>|null $articleType
     * @param Date|DateShape|null $date
     * @param list<SourceCountry|value-of<SourceCountry>>|null $sourceCountry
     * @param list<string>|null $sourceDomain
     */
    public static function with(
        ?array $articleLanguage = null,
        ?array $articleType = null,
        Date|array|null $date = null,
        ?array $sourceCountry = null,
        ?array $sourceDomain = null,
    ): self {
        $self = new self;

        null !== $articleLanguage && $self['articleLanguage'] = $articleLanguage;
        null !== $articleType && $self['articleType'] = $articleType;
        null !== $date && $self['date'] = $date;
        null !== $sourceCountry && $self['sourceCountry'] = $sourceCountry;
        null !== $sourceDomain && $self['sourceDomain'] = $sourceDomain;

        return $self;
    }

    /**
     * Article languages to include. Up to 3.
     *
     * @param list<ArticleLanguage|value-of<ArticleLanguage>> $articleLanguage
     */
    public function withArticleLanguage(array $articleLanguage): self
    {
        $self = clone $this;
        $self['articleLanguage'] = $articleLanguage;

        return $self;
    }

    /**
     * Article types to include. Up to 3.
     *
     * @param list<ArticleType|value-of<ArticleType>> $articleType
     */
    public function withArticleType(array $articleType): self
    {
        $self = clone $this;
        $self['articleType'] = $articleType;

        return $self;
    }

    /**
     * Published-at window in epoch milliseconds.
     *
     * @param Date|DateShape $date
     */
    public function withDate(Date|array $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * Publisher countries to include, as lowercase ISO 3166-1 alpha-2 codes. Up to 3.
     *
     * @param list<SourceCountry|value-of<SourceCountry>> $sourceCountry
     */
    public function withSourceCountry(array $sourceCountry): self
    {
        $self = clone $this;
        $self['sourceCountry'] = $sourceCountry;

        return $self;
    }

    /**
     * Publisher domains to include. Up to 3.
     *
     * @param list<string> $sourceDomain
     */
    public function withSourceDomain(array $sourceDomain): self
    {
        $self = clone $this;
        $self['sourceDomain'] = $sourceDomain;

        return $self;
    }
}
