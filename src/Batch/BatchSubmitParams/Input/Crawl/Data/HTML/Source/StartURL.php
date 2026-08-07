<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\StartURL\Controls;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Discover pages by following links from one URL.
 *
 * @phpstan-import-type ControlsShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\StartURL\Controls
 *
 * @phpstan-type StartURLShape = array{
 *   type: 'start_url', url: string, controls?: null|Controls|ControlsShape
 * }
 */
final class StartURL implements BaseModel
{
    /** @use SdkModel<StartURLShape> */
    use SdkModel;

    /**
     * Start from one page.
     *
     * @var 'start_url' $type
     */
    #[Required]
    public string $type = 'start_url';

    /**
     * Page where crawling begins. A URL without a scheme is read as https://.
     */
    #[Required]
    public string $url;

    /**
     * Limits and filters for page discovery.
     */
    #[Optional]
    public ?Controls $controls;

    /**
     * `new StartURL()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StartURL::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StartURL)->withURL(...)
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
     * @param Controls|ControlsShape|null $controls
     */
    public static function with(
        string $url,
        Controls|array|null $controls = null
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $controls && $self['controls'] = $controls;

        return $self;
    }

    /**
     * Start from one page.
     *
     * @param 'start_url' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Page where crawling begins. A URL without a scheme is read as https://.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Limits and filters for page discovery.
     *
     * @param Controls|ControlsShape $controls
     */
    public function withControls(Controls|array $controls): self
    {
        $self = clone $this;
        $self['controls'] = $controls;

        return $self;
    }
}
