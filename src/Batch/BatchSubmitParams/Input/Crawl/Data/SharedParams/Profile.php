<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Profile\ExistingProfile;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Profile\NewProfile;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Create or reuse an authenticated browser profile. Requires a paid plan and an HTTPS target. Profiles persist session state, bypass shared caches, and cannot be combined with ZDR, custom headers, raw bytes, or prebuilt parsers.
 *
 * @phpstan-import-type ExistingProfileShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Profile\ExistingProfile
 * @phpstan-import-type NewProfileShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Profile\NewProfile
 *
 * @phpstan-type ProfileVariants = ExistingProfile|NewProfile
 * @phpstan-type ProfileShape = ProfileVariants|ExistingProfileShape|NewProfileShape
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
        return ['existing' => ExistingProfile::class, 'new' => NewProfile::class];
    }
}
