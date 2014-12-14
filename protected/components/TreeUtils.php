<?php

/**
 * Class TreeUtils
 * @author Me
 */

use Underscore\Types\Arrays;

class TreeUtils
{
    /**
     * Recorre arbol en prefijo
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
        $array = $value; 
        /**
        * Se coloca array vacío para evitar que
        * Echo CJSON::encode mande un array en lugar de un objeto
        * en getPreguntas
         */
        $array["children"] = array();
        if ($children) {
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

