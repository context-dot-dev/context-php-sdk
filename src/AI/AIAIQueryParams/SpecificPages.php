<?php

declare(strict_types=1);

namespace ContextDev\AI\AIAIQueryParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Optional object specifying which pages to analyze.
 *
 * @phpstan-type SpecificPagesShape = array{
 *   aboutUs?: bool|null,
 *   blog?: bool|null,
 *   careers?: bool|null,
 *   contactUs?: bool|null,
 *   faq?: bool|null,
 *   homePage?: bool|null,
 *   pricing?: bool|null,
 *   privacyPolicy?: bool|null,
 *   termsAndConditions?: bool|null,
 * }
 */
final class SpecificPages implements BaseModel
{
    /** @use SdkModel<SpecificPagesShape> */
    use SdkModel;

    /**
     * Whether to analyze the about us page.
     */
    #[Optional('about_us')]
    public ?bool $aboutUs;

    /**
     * Whether to analyze the blog.
     */
    #[Optional]
    public ?bool $blog;

    /**
     * Whether to analyze the careers page.
     */
    #[Optional]
    public ?bool $careers;

    /**
     * Whether to analyze the contact us page.
     */
    #[Optional('contact_us')]
    public ?bool $contactUs;

    /**
     * Whether to analyze the FAQ page.
     */
    #[Optional]
    public ?bool $faq;

    /**
     * Whether to analyze the home page.
     */
    #[Optional('home_page')]
    public ?bool $homePage;

    /**
     * Whether to analyze the pricing page.
     */
    #[Optional]
    public ?bool $pricing;

    /**
     * Whether to analyze the privacy policy page.
     */
    #[Optional('privacy_policy')]
    public ?bool $privacyPolicy;

    /**
     * Whether to analyze the terms and conditions page.
     */
    #[Optional('terms_and_conditions')]
    public ?bool $termsAndConditions;

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
        ?bool $aboutUs = null,
        ?bool $blog = null,
        ?bool $careers = null,
        ?bool $contactUs = null,
        ?bool $faq = null,
        ?bool $homePage = null,
        ?bool $pricing = null,
        ?bool $privacyPolicy = null,
        ?bool $termsAndConditions = null,
    ): self {
        $self = new self;

        null !== $aboutUs && $self['aboutUs'] = $aboutUs;
        null !== $blog && $self['blog'] = $blog;
        null !== $careers && $self['careers'] = $careers;
        null !== $contactUs && $self['contactUs'] = $contactUs;
        null !== $faq && $self['faq'] = $faq;
        null !== $homePage && $self['homePage'] = $homePage;
        null !== $pricing && $self['pricing'] = $pricing;
        null !== $privacyPolicy && $self['privacyPolicy'] = $privacyPolicy;
        null !== $termsAndConditions && $self['termsAndConditions'] = $termsAndConditions;

        return $self;
    }

    /**
     * Whether to analyze the about us page.
     */
    public function withAboutUs(bool $aboutUs): self
    {
        $self = clone $this;
        $self['aboutUs'] = $aboutUs;

        return $self;
    }

    /**
     * Whether to analyze the blog.
     */
    public function withBlog(bool $blog): self
    {
        $self = clone $this;
        $self['blog'] = $blog;

        return $self;
    }

    /**
     * Whether to analyze the careers page.
     */
    public function withCareers(bool $careers): self
    {
        $self = clone $this;
        $self['careers'] = $careers;

        return $self;
    }

    /**
     * Whether to analyze the contact us page.
     */
    public function withContactUs(bool $contactUs): self
    {
        $self = clone $this;
        $self['contactUs'] = $contactUs;

        return $self;
    }

    /**
     * Whether to analyze the FAQ page.
     */
    public function withFaq(bool $faq): self
    {
        $self = clone $this;
        $self['faq'] = $faq;

        return $self;
    }

    /**
     * Whether to analyze the home page.
     */
    public function withHomePage(bool $homePage): self
    {
        $self = clone $this;
        $self['homePage'] = $homePage;

        return $self;
    }

    /**
     * Whether to analyze the pricing page.
     */
    public function withPricing(bool $pricing): self
    {
        $self = clone $this;
        $self['pricing'] = $pricing;

        return $self;
    }

    /**
     * Whether to analyze the privacy policy page.
     */
    public function withPrivacyPolicy(bool $privacyPolicy): self
    {
        $self = clone $this;
        $self['privacyPolicy'] = $privacyPolicy;

        return $self;
    }

    /**
     * Whether to analyze the terms and conditions page.
     */
    public function withTermsAndConditions(bool $termsAndConditions): self
    {
        $self = clone $this;
        $self['termsAndConditions'] = $termsAndConditions;

        return $self;
    }
}
