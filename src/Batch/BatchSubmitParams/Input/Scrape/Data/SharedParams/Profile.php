<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile\Existing;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Profile\New_;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Scrape as a signed-in user. Create a profile with `type: "new"` and your credentials, then reuse it with `type: "existing"`. Requires a paid plan and an HTTPS URL. Profiles keep their session between requests, skip the cache, and cannot be combined with ZDR, custom headers, `formats.bytes`, or prebuilt parsers other than `emails`, `phone-numbers`, and `links`.
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
