<?php

/**
 * Class StringUtils
 * @author Me
 */
class StringUtils
{
    /**
     * undocumented function
     *
     * @return void
     */
    public static function getQuotedSurroundedStr($str)
    {
        return "'" . addslashes($str) . "'";
    }
    
}

