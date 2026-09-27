<?php

declare(strict_types=1);

namespace ContextDev\Feedback;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Feedback\FeedbackSubmitResponse\KeyMetadata;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Feedback\FeedbackSubmitResponse\KeyMetadata
 *
 * @phpstan-type FeedbackSubmitResponseShape = array{
 *   alreadySubmitted: bool,
 *   feedbackID: string,
 *   requestID: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class FeedbackSubmitResponse implements BaseModel
{
    /** @use SdkModel<FeedbackSubmitResponseShape> */
    use SdkModel;

    /**
     * True when feedback for this request_id was already recorded; the original feedback_id is returned.
     */
    #[Required('already_submitted')]
    public bool $alreadySubmitted;

    /**
     * ID of the stored feedback.
     */
    #[Required('feedback_id')]
    public string $feedbackID;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new FeedbackSubmitResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeedbackSubmitResponse::with(
     *   alreadySubmitted: ..., feedbackID: ..., requestID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeedbackSubmitResponse)
     *   ->withAlreadySubmitted(...)
     *   ->withFeedbackID(...)
     *   ->withRequestID(...)
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
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        bool $alreadySubmitted,
        string $feedbackID,
        string $requestID,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['alreadySubmitted'] = $alreadySubmitted;
        $self['feedbackID'] = $feedbackID;
        $self['requestID'] = $requestID;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * True when feedback for this request_id was already recorded; the original feedback_id is returned.
     */
    public function withAlreadySubmitted(bool $alreadySubmitted): self
    {
        $self = clone $this;
        $self['alreadySubmitted'] = $alreadySubmitted;

        return $self;
    }

    /**
     * ID of the stored feedback.
     */
    public function withFeedbackID(string $feedbackID): self
    {
        $self = clone $this;
        $self['feedbackID'] = $feedbackID;

        return $self;
    }

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Credit usage, included whenever a valid API key is provided.
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
