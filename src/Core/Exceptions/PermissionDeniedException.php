<?php

namespace ContextDev\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ContextDev Permission Denied Exception';
}
