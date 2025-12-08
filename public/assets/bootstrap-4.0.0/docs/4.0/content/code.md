<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Functionality for the navigation tree
 *
 * @package PhpMyAdmin-Navigation
 */
namespace PMA\libraries\navigation\nodes;

use PMA\libraries\Util;
use PMA\libraries\URL;

/**
 * Represents a database node in the navigation tree
 *
 * @package PhpMyAdmin-Navigation
 */
class NodeDatabase extends Node
{
    /**
     * The number of hidden items in this database
     *
     * @var int
     */
    protected $hiddenCount = 0;

    /**
     * Initialises the class
     *
     * @param string $name     An identifier for the new node
     * @param int    $type     Type of node, may be one of CONTAINER or OBJECT
     * @param bool   $is_group Whether this object has been created
     *                         while grouping nodes
     */
    public function __construct($name, $type = Node::OBJECT, $is_group = false)
    {
        parent::__construct($name, $type, $is_group);
        $this->icon = Util::getImage(
            's_db.png',
            __('Database operations')
        );

        $script_name = Util::getScriptNameForOption(
            $GLOBALS['cfg']['DefaultTabDatabase'],
            'database'
        );
        $this->links = array(
            'text'  => $script_name
                . '?server=' . $GLOBALS['server']
                . '&amp;db=%1$s&amp;token=' . $_SESSION[' PMA_token '],
            'icon'  => 'db_operations.php?server=' . $GLOBALS['se