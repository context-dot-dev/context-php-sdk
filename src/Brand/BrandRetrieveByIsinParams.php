<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandRetrieveByIsinParams\ForceLanguage;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Retrieve brand information using an ISIN (International Securities Identification Number).
 *
 * @see ContextDev\Services\BrandService::retrieveByIsin()
 *
 * @phpstan-type BrandRetrieveByIsinParamsShape = array{
 *   isin: string,
 *   forceLanguage?: null|ForceLanguage|value-of<ForceLanguage>,
 *   maxAgeMs?: int|null,
 *   maxSpeed?: bool|null,
 *   timeoutMs?: int|null,
 * }
 */
final class BrandRetrieveByIsinParams implements BaseModel
{
    /** @use SdkModel<BrandRetrieveByIsinParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ISIN (International Securities Identification Number) to retrieve brand data for (e.g., 'AU000000IMD5', 'US0378331005'). Must be exactly 12 characters: 2 letters followed by 9 alphanumeric characters and ending with a digit.
     */
    #[Required]
    public string $isin;

    /**
     * Optional parameter to force the language of the retrieved brand data.
     *
     * @var value-of<ForceLanguage>|null $forceLanguage
     */
    #[Optional(enum: ForceLanguage::class)]
    public ?string $forceLanguage;

    /**
     * Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     */
    #[Optional]
    public ?bool $maxSpeed;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * `new BrandRetrieveByIsinParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandRetrieveByIsinParams::with(isin: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandRetrieveByIsinParams)->withIsin(...)
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
     * @param ForceLanguage|value-of<ForceLanguage>|null $forceLanguage
     */
    public static function with(
        string $isin,
        ForceLanguage|string|null $forceLanguage = null,
        ?int $maxAgeMs = null,
        ?bool $maxSpeed = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['isin'] = $isin;

        null !== $forceLanguage && $self['forceLanguage'] = $forceLanguage;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $maxSpeed && $self['maxSpeed'] = $maxSpeed;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * ISIN (International Securities Identification Number) to retrieve brand data for (e.g., 'AU000000IMD5', 'US0378331005'). Must be exactly 12 characters: 2 letters followed by 9 alphanumeric characters and ending with a digit.
     */
    public function withIsin(string $isin): self
    {
        $self = clone $this;
        $self['isin'] = $isin;

        return $self;
    }

    /**
     * Optional parameter to force the language of the retrieved brand data.
     *
     * @param ForceLanguage|value-of<ForceLanguage> $forceLanguage
     */
    public function withForceLanguage(ForceLanguage|string $forceLanguage): self
    {
        $self = clone $this;
        $self['forceLanguage'] = $forceLanguage;

        return $self;
    }

    /**
     * Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     */
    public function withMaxAgeMs(int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     */
    public function withMaxSpeed(bool $maxSpeed): self
    {
        $self = clone $this;
        $self['maxSpeed'] = $maxSpeed;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
