<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse\Person;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SkillShape = array{
 *   name: string, normalized?: string|null, proficiency?: string|null
 * }
 */
final class Skill implements BaseModel
{
    /** @use SdkModel<SkillShape> */
    use SdkModel;

    /**
     * Skill name.
     */
    #[Required]
    public string $name;

    /**
     * Standardized skill name, when available.
     */
    #[Optional]
    public ?string $normalized;

    /**
     * Skill proficiency, when available.
     */
    #[Optional]
    public ?string $proficiency;

    /**
     * `new Skill()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Skill::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Skill)->withName(...)
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
     */
    public static function with(
        string $name,
        ?string $normalized = null,
        ?string $proficiency = null
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $normalized && $self['normalized'] = $normalized;
        null !== $proficiency && $self['proficiency'] = $proficiency;

        return $self;
    }

    /**
     * Skill name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Standardized skill name, when available.
     */
    public function withNormalized(string $normalized): self
    {
        $self = clone $this;
        $self['normalized'] = $normalized;

        return $self;
    }

    /**
     * Skill proficiency, when available.
     */
    public function withProficiency(string $proficiency): self
    {
        $self = clone $this;
        $self['proficiency'] = $proficiency;

        return $self;
    }
}
