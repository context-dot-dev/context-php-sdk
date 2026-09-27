<?php

declare(strict_types=1);

namespace ContextDev\Feedback;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Feedback\FeedbackSubmitParams\Category;

/**
 * Report an API issue or documentation mismatch, including request IDs when available.
 *
 * @see ContextDev\Services\FeedbackService::submit()
 *
 * @phpstan-type FeedbackSubmitParamsShape = array{
 *   category: Category|value-of<Category>,
 *   note: string,
 *   requestID?: string|null,
 *   tags?: list<string>|null,
 *   url?: string|null,
 * }
 */
final class FeedbackSubmitParams implements BaseModel
{
    /** @use SdkModel<FeedbackSubmitParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Kind of issue.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * What went wrong and what you expected instead.
     */
    #[Required]
    public string $note;

    /**
     * The request_id of the API call the feedback is about, from its response body or X-Request-Id header.
     */
    #[Optional('request_id')]
    public ?string $requestID;

    /**
     * Labels for filtering usage in the dashboard.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * The page the feedback is about, such as one page of a crawl or a docs page.
     */
    #[Optional]
    public ?string $url;

    /**
     * `new FeedbackSubmitParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeedbackSubmitParams::with(category: ..., note: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeedbackSubmitParams)->withCategory(...)->withNote(...)
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
     * @param Category|value-of<Category> $category
     * @param list<string>|null $tags
     */
    public static function with(
        Category|string $category,
        string $note,
        ?string $requestID = null,
        ?array $tags = null,
        ?string $url = null,
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['note'] = $note;

        null !== $requestID && $self['requestID'] = $requestID;
        null !== $tags && $self['tags'] = $tags;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Kind of issue.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * What went wrong and what you expected instead.
     */
    public function withNote(string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }

    /**
     * The request_id of the API call the feedback is about, from its response body or X-Request-Id header.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Labels for filtering usage in the dashboard.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * The page the feedback is about, such as one page of a crawl or a docs page.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
