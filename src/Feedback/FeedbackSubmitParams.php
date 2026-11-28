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
 * Report a bug, docs mismatch, or wrong result to the Context.dev team. Send `request_id`, `url`, or both. Any API key can submit, and a repeat report for the same `request_id` returns the original feedback.
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
     * Kind of issue. Use `quality_degradation` for wrong or incomplete results and `bad_brand` for wrong or outdated brand data, such as a logo or colors.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * What went wrong and what you expected instead. Leave out API keys and personal data.
     */
    #[Required]
    public string $note;

    /**
     * ID of the API call the feedback is about, from its `request_id` or `X-Request-Id` header. Send this, `url`, or both.
     */
    #[Optional('request_id')]
    public ?string $requestID;

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * URL the feedback is about, such as one page of a crawl or a docs page. Send this, `request_id`, or both.
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
     * Kind of issue. Use `quality_degradation` for wrong or incomplete results and `bad_brand` for wrong or outdated brand data, such as a logo or colors.
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
     * What went wrong and what you expected instead. Leave out API keys and personal data.
     */
    public function withNote(string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }

    /**
     * ID of the API call the feedback is about, from its `request_id` or `X-Request-Id` header. Send this, `url`, or both.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
     * URL the feedback is about, such as one page of a crawl or a docs page. Send this, `request_id`, or both.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
