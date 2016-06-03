<?php
namespace DEE\CoreBundle\Utils;

/**
 * Description of ArrayFormatter
 *
 * @author kbj
 */
class ArrayFormatter {
    
    /** 
     * UTF8 encode array's keys & values 
     * @param array $arrayToEncode
     * @return array : UTF8 encoded array
     */
    public static function encodeUtf8($arrayToEncode) {
        
        // Go through the whole array & encode key AND value
        foreach($arrayToEncode as $key => $value) {
            if (is_string($value)) {
                $encodedArray[utf8_encode($key)] = utf8_encode($value);
            } else {
                $encodedArray[utf8_encode($key)] = utf8_encode(implode($value));
             }
        }
        
        return $encodedArray;
    }
    
    /**
     * Correct array keys when an object has been cast to an array
     * Because private and protected properties are cast with special chars before their label
     *  /!\ Object properties must not be public, or it won't work
     * @param type $arrayToCorrect
     * @return type
     */
    public static function setCorrectKeysAfterArrayCast($arrayToCorrect) {
        $correctedArray = array();
        
        foreach($arrayToCorrect as $key => $value) {
           $correctedArray[substr($key, 3)] = $value;
        }
        return $correctedArray;
    }
}
