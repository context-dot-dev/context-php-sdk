<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile\Existing;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile\New_;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Create or reuse an authenticated browser profile. Requires a paid plan and an HTTPS target. Profiles persist session state, bypass shared caches, and cannot be combined with ZDR, custom headers, raw bytes, or prebuilt parsers.
 *
 * @phpstan-import-type ExistingShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile\Existing
 * @phpstan-import-type NewShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile\New_
 *
 * @phpstan-type ProfileVariants = Existing|New_
 * @phpstan-type ProfileShape = ProfileVariants|ExistingShape|NewShape
 */
final class Profile implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['existing' => Existing::class, 'new' => New_::class];
    }
}
