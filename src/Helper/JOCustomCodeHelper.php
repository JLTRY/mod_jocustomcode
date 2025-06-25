<?php

/*------------------------------------------------------------------------
# mod_jocustomcode - JO's Custom Code
# ------------------------------------------------------------------------
# author    JL TRYOEN / RBO Team > Project::: RumahBelanja.com & AppsNity.com
# Copyright (C) 2025 www.jltryoen.fr All Rights Reserved.
# @license  http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
# Websites: http://www.jltryoen.fr
-------------------------------------------------------------------------*/

namespace JLTRY\Module\JOCustomCode\Site\Helper;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

class JOCustomCodeHelper
{
    public static function parsePHPviaFile($codearea)
    {
        $tmpfname = tempnam(JPATH_SITE . "/tmp", "html");
        $handle = fopen($tmpfname, "w");
        fwrite($handle, $codearea, strlen($codearea));
        fclose($handle);
        include_once($tmpfname);
        unlink($tmpfname);
    }
}
