<?php

namespace ContextDev\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ContextDev Not Found Exception';
}
