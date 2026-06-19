<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideResponse\KeyMetadata;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebExtractStyleguideResponse\KeyMetadata
 * @phpstan-import-type StyleguideShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide
 *
 * @phpstan-type WebExtractStyleguideResponseShape = array{
 *   code?: int|null,
 *   domain?: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   status?: string|null,
 *   styleguide?: null|Styleguide|StyleguideShape,
 * }
 */
final class WebExtractStyleguideResponse implements BaseModel
{
    /** @use SdkModel<WebExtractStyleguideResponseShape> */
    use SdkModel;

    /**
     * HTTP status code.
     */
    #[Optional]
    public ?int $code;

    /**
     * The normalized domain that was processed.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Status of the response, e.g., 'ok'.
     */
    #[Optional]
    public ?string $status;

    /**
     * Comprehensive styleguide data extracted from the website.
     */
    #[Optional]
    public ?Styleguide $styleguide;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     * @param Styleguide|StyleguideShape|null $styleguide
     */
    public static function with(
        ?int $code = null,
        ?string $domain = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $status = null,
        Styleguide|array|null $styleguide = null,
    ): self {
        $self = new self;

        null !== $code && $self['code'] = $code;
        null !== $domain && $self['domain'] = $domain;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $status && $self['status'] = $status;
        null !== $styleguide && $self['styleguide'] = $styleguide;

        return $self;
    }

    /**
     * HTTP status code.
     */
    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * The normalized domain that was processed.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Status of the response, e.g., 'ok'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Comprehensive styleguide data extracted from the website.
     *
     * @param Styleguide|StyleguideShape $styleguide
     */
    public function withStyleguide(Styleguide|array $styleguide): self
    {
        $self = clone $this;
        $self['styleguide'] = $styleguide;

        return $self;
    }
}
