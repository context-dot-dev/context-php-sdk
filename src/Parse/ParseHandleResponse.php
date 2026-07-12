<?php

declare(strict_types=1);

namespace ContextDev\Parse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Parse\ParseHandleResponse\KeyMetadata;
use ContextDev\Parse\ParseHandleResponse\Type;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Parse\ParseHandleResponse\KeyMetadata
 *
 * @phpstan-type ParseHandleResponseShape = array{
 *   markdown: string,
 *   success: bool,
 *   type: Type|value-of<Type>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class ParseHandleResponse implements BaseModel
{
    /** @use SdkModel<ParseHandleResponseShape> */
    use SdkModel;

    /**
     * Input bytes converted to GitHub Flavored Markdown.
     */
    #[Required]
    public string $markdown;

    /**
     * Indicates success.
     */
    #[Required]
    public bool $success;

    /**
     * Detected content type used for parsing.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new ParseHandleResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParseHandleResponse::with(markdown: ..., success: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParseHandleResponse)->withMarkdown(...)->withSuccess(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $markdown,
        bool $success,
        Type|string $type,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['markdown'] = $markdown;
        $self['success'] = $success;
        $self['type'] = $type;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Input bytes converted to GitHub Flavored Markdown.
     */
    public function withMarkdown(string $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * Indicates success.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Detected content type used for parsing.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

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
}
