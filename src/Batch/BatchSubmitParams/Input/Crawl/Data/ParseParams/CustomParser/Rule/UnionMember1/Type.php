<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ParseParams\CustomParser\Rule\UnionMember1;

/**
 * Return the first match with `item` or all matches with `list`.
 */
enum Type: string
{
    case ITEM = 'item';

    case LIST = 'list';
}
