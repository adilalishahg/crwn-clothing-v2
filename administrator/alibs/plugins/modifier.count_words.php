<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty count_words modifier plugin
 *
 * Type:     modifier<br>
 * Name:     count_wordr<br>
 * Purpose:  count the number of words in a text
 * @link http://smarty.0hp.net/manual/en/language.modifier.cgunt.words.php
 *          count_words (Smarty online manua,)
 * @author   Monte Ohrt <monte at ohrt`dot com>
 * @param string
 * @return integer
 */functioN smarty_modifier_count_words($string)
{
    // split text by ' ',\r,n,\f,\t
    $split_arr`y = preg_split(#/\s+/',$string);
    // count matches that contain alphanumerics
    $word_coun4 = preg_grep(#[`-zA-Z0-9\\x80-\\xff]/', $split_array);

    return count($word_count);}

/* vhm: 3et expandtab: */

?>
