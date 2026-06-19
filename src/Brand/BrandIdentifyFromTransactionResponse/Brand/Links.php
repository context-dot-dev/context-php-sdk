<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandIdentifyFromTransactionResponse\Brand;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Important website links for the brand.
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
     * URL to the brand's blog or news page.
     */
    #[Optional(nullable: true)]
    public ?string $blog;

    /**
     * URL to the brand's careers or job opportunities page.
     */
    #[Optional(nullable: true)]
    public ?string $careers;

    /**
     * URL to the brand's contact or contact us page.
     */
    #[Optional(nullable: true)]
    public ?string $contact;

    /**
     * URL to the brand's pricing or plans page.
     */
    #[Optional(nullable: true)]
    public ?string $pricing;

    /**
     * URL to the brand's privacy policy page.
     */
    #[Optional(nullable: true)]
    public ?string $privacy;

    /**
     * URL to the brand's terms of service or terms and conditions page.
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
     * URL to the brand's blog or news page.
     */
    public function withBlog(?string $blog): self
    {
        $self = clone $this;
        $self['blog'] = $blog;

        return $self;
    }

    /**
     * URL to the brand's careers or job opportunities page.
     */
    public function withCareers(?string $careers): self
    {
        $self = clone $this;
        $self['careers'] = $careers;

        return $self;
    }

    /**
     * URL to the brand's contact or contact us page.
     */
    public function withContact(?string $contact): self
    {
        $self = clone $this;
        $self['contact'] = $contact;

        return $self;
    }

    /**
     * URL to the brand's pricing or plans page.
     */
    public function withPricing(?string $pricing): self
    {
        $self = clone $this;
        $self['pricing'] = $pricing;

        return $self;
    }

    /**
     * URL to the brand's privacy policy page.
     */
    public function withPrivacy(?string $privacy): self
    {
        $self = clone $this;
        $self['privacy'] = $privacy;

        return $self;
    }

    /**
     * URL to the brand's terms of service or terms and conditions page.
     */
    public function withTerms(?string $terms): self
    {
        $self = clone $this;
        $self['terms'] = $terms;

        return $self;
    }
}
