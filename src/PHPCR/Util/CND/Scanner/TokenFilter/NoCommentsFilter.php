<?php

namespace PHPCR\Util\CND\Scanner\TokenFilter;

use PHPCR\Util\CND\Scanner\GenericToken;

/**
 * @author Daniel Barsotti <daniel.barsotti@liip.ch>
 */
class NoCommentsFilter extends TokenTypeFilter
{
    function __construct()
    {
        parent::__construct(GenericToken::TK_COMMENT);
    }
}
