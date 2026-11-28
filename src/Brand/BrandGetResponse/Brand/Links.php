<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse\Brand;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Key pages on the brand's website.
 *
 * @phpstan-type LinksShape = array{
 *   blog?: string|null,
 *   careers?: string|null,
 *   contact?: string|null,
 *   pricing?: string|null,
 *   privacy?: string|null,
 *   terms?: string|null,
 * }
 */
final class Links implements BaseModel
{
    /** @use SdkModel<LinksShape> */
    use SdkModel;

    /**
     * URL of the blog or newsroom. `null` when not found.
     */
    #[Optional(nullable: true)]
    public ?string $blog;

    /**
     * URL of the careers page. `null` when not found.
     */
    #[Optional(nullable: true)]
    public ?string $careers;

    /**
     * URL of the contact page. `null` when not found.
     */
    #[Optional(nullable: true)]
    public ?string $contact;

    /**
     * URL of the pricing page. `null` when not found.
     */
    #[Optional(nullable: true)]
    public ?string $pricing;

    /**
     * URL of the privacy policy. `null` when not found.
     */
    #[Optional(nullable: true)]
    public ?string $privacy;

    /**
     * URL of the terms of service. `null` when not found.
     */
    #[Optional(nullable: true)]
    public ?string $terms;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $blog = null,
        ?string $careers = null,
        ?string $contact = null,
        ?string $pricing = null,
        ?string $privacy = null,
        ?string $terms = null,
    ): self {
        $self = new self;

        null !== $blog && $self['blog'] = $blog;
        null !== $careers && $self['careers'] = $careers;
        null !== $contact && $self['contact'] = $contact;
        null !== $pricing && $self['pricing'] = $pricing;
        null !== $privacy && $self['privacy'] = $privacy;
        null !== $terms && $self['terms'] = $terms;

        return $self;
    }

    /**
     * URL of the blog or newsroom. `null` when not found.
     */
    public function withBlog(?string $blog): self
    {
        $self = clone $this;
        $self['blog'] = $blog;

        return $self;
    }

    /**
     * URL of the careers page. `null` when not found.
     */
    public function withCareers(?string $careers): self
    {
        $self = clone $this;
        $self['careers'] = $careers;

        return $self;
    }

    /**
     * URL of the contact page. `null` when not found.
     */
    public function withContact(?string $contact): self
    {
        $self = clone $this;
        $self['contact'] = $contact;

        return $self;
    }

    /**
     * URL of the pricing page. `null` when not found.
     */
    public function withPricing(?string $pricing): self
    {
        $self = clone $this;
        $self['pricing'] = $pricing;

        return $self;
    }

    /**
     * URL of the privacy policy. `null` when not found.
     */
    public function withPrivacy(?string $privacy): self
    {
        $self = clone $this;
        $self['privacy'] = $privacy;

        return $self;
    }

    /**
     * URL of the terms of service. `null` when not found.
     */
    public function withTerms(?string $terms): self
    {
        $self = clone $this;
        $self['terms'] = $terms;

        return $self;
    }
}
