<?php

/**
 * Class TreeUtils
 * @author Me
 */

use Underscore\Types\Arrays;

class TreeUtils
{
    /**
     * Recorre arbo en prefijo
     * y luego lo retorna
     *
     * @return void
     */
    protected static function getTreeArrayInternal($node)
    {
        if($node == null){
            return array();
        }
        $value = $node->getValue();     
        $children = $node->getChildren();
        $array = array($value);
        if ($children) {
            $array["children"] = array();
            foreach ($children as $child) {
                $array["children"][] = static::getTreeArrayInternal($child);
            }
        }
        return $array;
    }
    /**
     * undocumented function
     *
     * @return void
     */
    public static function getTreeArray(Array $tree)
    {
        $node = Arrays::from($tree)->first()->obtain();
        $retVal = static::getTreeArrayInternal($node);
        return $retVal;
    }
    
    
}

