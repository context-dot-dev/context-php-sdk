<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandRetrieveParams;

/**
 * Discriminator for transaction-based brand retrieval.
 */
enum Type: string
{
    case BY_TRANSACTION = 'by_transaction';
}
