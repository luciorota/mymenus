<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @package         Mymenus
 * @since           1.0
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id: smarty.php 12940 2015-01-21 17:33:38Z zyspec $
 */

defined("XOOPS_ROOT_PATH") or exit("Restricted access");

/**
 * Class SmartyMymenusPluginItem
 */
class SmartyMymenusPluginItem extends MymenusPluginItem
{

    public function eventLinkDecoration()
    {
        $registry =& MymenusRegistry::getInstance();
        $linkArray = $registry->getEntry('link_array');
        $linkArray['link'] = self::_doDecoration($linkArray['link']);
        $registry->setEntry('link_array', $linkArray);
    }

    public function eventImageDecoration()
    {
        $registry =& MymenusRegistry::getInstance();
        $linkArray = $registry->getEntry('link_array');
        $linkArray['image'] = self::_doDecoration($linkArray['image']);
        $registry->setEntry('link_array', $linkArray);
    }

    public function eventTitleDecoration()
    {
        $registry =& MymenusRegistry::getInstance();
        $linkArray = $registry->getEntry('link_array');
        $linkArray['title'] = self::_doDecoration($linkArray['title']);
        $registry->setEntry('link_array', $linkArray);
    }

    public function eventAlttitleDecoration()
    {
        $registry =& MymenusRegistry::getInstance();
        $linkArray = $registry->getEntry('link_array');
        $linkArray['alt_title'] = self::_doDecoration($linkArray['alt_title']);
        $registry->setEntry('link_array', $linkArray);
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    private function _doDecoration($string)
    {
        $registry =& MymenusRegistry::getInstance();
        if (!preg_match('/{(.*\|.*)}/i', $string, $reg)) {
            return $string;
        }

        $expression = $reg[0];
        list($validator, $value) = array_map('mb_strtolower', explode('|', $reg[1]));

        if ($validator == 'smarty') {
            if (isset($GLOBALS['xoopsTpl']->_tpl_vars[$value])) {
               $string = str_replace($expression, $GLOBALS['xoopsTpl']->_tpl_vars[$value], $string);
            }
        }

        return $string;
    }

}
