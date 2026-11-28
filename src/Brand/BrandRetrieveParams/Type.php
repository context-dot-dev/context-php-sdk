<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandRetrieveParams;

/**
 * Set to `by_transaction` to identify the merchant behind a transaction descriptor.
 */
enum Type: string
{
    case BY_TRANSACTION = 'by_transaction';
}
