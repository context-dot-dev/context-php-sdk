<?php

declare(strict_types=1);

namespace ContextDev\Utility\UtilityPrefetchParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchDomainIdentifier;
use ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchEmailIdentifier;

/**
 * Identifier of the target to prefetch. Provide exactly one of domain or email.
 *
 * @phpstan-import-type UtilityPrefetchDomainIdentifierShape from \ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchDomainIdentifier
 * @phpstan-import-type UtilityPrefetchEmailIdentifierShape from \ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchEmailIdentifier
 *
 * @phpstan-type IdentifierVariants = UtilityPrefetchDomainIdentifier|UtilityPrefetchEmailIdentifier
 * @phpstan-type IdentifierShape = IdentifierVariants|UtilityPrefetchDomainIdentifierShape|UtilityPrefetchEmailIdentifierShape
 */
final class Identifier implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            UtilityPrefetchDomainIdentifier::class,
            UtilityPrefetchEmailIdentifier::class,
        ];
    }
}
