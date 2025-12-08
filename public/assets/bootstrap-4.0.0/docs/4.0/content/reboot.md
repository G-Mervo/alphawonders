   The type of item we are looking for
     *                             ('tables', 'views', etc)
     * @param int    $pos          The offset of the list within the results
     * @param string $searchClause A string used to filter the results of the query
     *
     * @return array
     */
    public function getData($type, $pos, $searchClause = '')
    {
        $retval = array();
        switch ($type) {
        case 'tables':
            $retval = $this->_getTables($pos, $searchClause);
            break;
        case 'views':
            $retval = $this->_getViews($pos, $searchClause);
            break;
        case 'procedures':
            $retval = $this->_getProcedures($pos, $searchClause);
            break;
        case 'functions':
            $retval = $this->_getFunctions($pos, $searchClause);
            break;
        case 'events':
            $retval = $this->_getEvents($pos, $searchClause);
            break;
        default:
            break;
        }

        // Remove hidden items so that they are not displayed in navigation tree
        $cfgRelation = PMA_getRelationsParam();
        if ($cfgRelation['navwork']) {
            $hiddenItems = $this->getHiddenItems(substr($type, 0, -1));
            foreach ($retval as $key => $item) {
                if (in_array($item, $hiddenItems)) {
                    unset($retval[$key]);
                }
            }
        }

        return $retval;
    }

    /**
     * Return list of hidden items of given type
     *
     * @param string $type The type of items we are looking for
     *                     ('table', 'function', 'group', etc.)
     *
     * @return array Array containing hidden items of given type
     */
    public function getHiddenItems($type)
    {
        $db = $this->real_name;
        $cfgRelation = PMA_getRelationsParam();
        if (empty($cfgRelation['navigationhiding'])) {
            return array();
        }
        $navTable = Util::backquote($cfgRelation['db'])
            . "." . Util::backquote($cfgRelation['navigationhiding']);
        $sqlQuery = "SELECT `item_name` FROM " . $navTable
            . " WHERE `username`='" . $cfgRelation['user'] . "'"
            . " AND `item_type`='" . $type
            . "'" . " AND `db_name`='" . $GLOBALS['dbi']->escapeString($db)
            . "'";
        $result = PMA_queryAsControlUser($sqlQuery, false);
        $hiddenItems = array();
        if ($result) {
            while ($row = $GLOBALS['dbi']->fetchArray($result)) {
                $hiddenItems[] = $row[0];
            }
        }
        $GLOBALS['dbi']->freeResult($result);

        return $hiddenItems;
    }

    /**
     * Returns the list of tables or views inside this database
     *
     * @param string $which        tables|views
     * @param int    $pos          The offset of the list within the results
     * @param string $searchClause A string used to filter the results of the query
     *
     * @return array
     */
    private function _getTablesOrViews($which, $pos, $searchClause)
    {
        if ($which == 'tables') {
            $condition = '=';
        } else {
            $condition = '!=';
        }
        $maxItems = $GLOBALS['cfg']['MaxNavigationItems'];
        $retval   = array();
        $db       = $this->real_name;
        if (! $GLOBALS['cfg']['Server']['DisableIS']) {
            $escdDb = $GLOBALS['dbi']->escapeString($db);
            $query  = "SELECT `TABLE_NAME` AS `name` ";
            $query .= "FROM `INFORMATION_SCHEMA`.`TABLES` ";
            $query .= "WHERE `TABLE_SCHEMA`='$escdDb' ";
            $query .= "AND `TABLE_TYPE`" . $condition . "'BASE TABLE' ";
            if (! empty($searchClause)) {
                $query .= "AND `TABLE_NAME` LIKE '%";
                $query .= $GLOBALS['dbi']->escapeString($searchClause);
                $query .= "%'";
            }
            $query .= "ORDER BY `TABLE_NAME` ASC ";
            $query .= "LIMIT " . intval($pos) . ", $maxItems";
            $retval = $GLOBALS['dbi']->fetchResult($query);
        } else {
            $query = " SHOW FULL TABLES FROM ";
            $query .= Util::backquote($db);
            $query .= " WHERE `Table_type`" . $condition . "'BASE TABLE' ";
            if (!empty($searchClause)) {
                $query .= "AND " . Util::backquote(
                    "Tables_in_" . $db
                );
                $query .= " LIKE '%" . $GLOBALS['dbi']->escapeString(
                    $searchClause
                );
                $query .= "%'";
            }
            $handle = $GLOBALS['dbi']->tryQuery($query);
            if ($handle !== false) {
                $count = 0;
                if ($GLOBALS['dbi']->dataSeek($handle, $pos)) {
                    while ($arr = $GLOBALS['dbi']->fetchArray($handle)) {
                        if ($count < $maxItems) {
                            $retval[] = $arr[0];
                            $count++;
                        } else {
                            break;
                        }
                    }
                }
            }
        }

        return $retval;
    }

    /**
     * Returns the list of tables inside this database
     *
     * @param int    $pos          The offset of the list within the results
     * @param string $searchClause A string used to filter the results of the query
     *
     * @return array
     */
    private function _getTables($pos, $searchClause)
    {
        return $this->_getTablesOrViews('tables', $pos, $searchClause);
    }

    /**
     * Returns the list of views inside this database
     *
     * @param int    $pos          The offset of the list within the results
     * @param string $searchClause A string used to filter the results of the query
     *
     * @return array
     */
    private function _getViews($pos, $searchClause)
    {
        return $this->_getTablesOrViews('views', $pos, $searchClause);
    }

    /**
     * Returns the list of procedures or functions inside this database
     *
     * @param string $routineType  PROCEDURE|FUNCTION
     * @param int    $pos          The offset of the list within the results
     * @param string $searchClause A string used to filter the results of the query
     *
     * @return array
     */
    private function _getRoutines($routineType, $pos, $searchClause)
    {
        $maxItems = $GLOBALS['cfg']['MaxNavigationItems'];
        $retval = array();
        $db = $this->real_name;
        if (!$GLOBALS['cfg']['Server']['DisableIS']) {
            $escdDb = $GLOBALS['dbi']->escapeString($db);
            $query = "SELECT `ROUTINE_NAME` AS `name` ";
            $query .= "FROM `INFORMATION_SCHEMA`.`ROUTINES` ";
            $query .= "WHERE `ROUTINE_SCHEMA` "
                . Util::getCollateForIS() . "='$escdDb'";
            $query .= "AND `ROUTINE_TYPE`='" . $routineType . "' ";
            if (!empty($searchClause)) {
                $query .= "AND `ROUTINE_NAME` LIKE '%";
                $query .= $GLOBALS['dbi']->escapeString($searchClause);
                $query .= "%'";
            }
            $query .= "ORDER BY `ROUTINE_NAME` ASC ";
            $query .= "LIMIT " . intval($pos) . ", $maxItems";
            $retval = $GLOBALS['dbi']->fetchResult($query);
        } else {
            $escdDb = $GLOBALS['dbi']->escapeString($db);
            $query = "SHOW " . $routineType . " STATUS WHERE `Db`='$escdDb' ";
            if (!empty($searchClause)) {
                $query .= "AND `Name` LIKE '%";
                $query .= $GLOBALS['dbi']->escapeString($searchClause);
                $query .= "%'";
            }
            $handle = $GLOBALS['dbi']->tryQuery($query);
            if ($handle !== false) {
                $count = 0;
                if ($GLOBALS['dbi']->dataSeek($handle, $pos)) {
                    while ($arr = $GLOBALS['dbi']->fetchArray($handle)) {
                        if ($count < $maxItems) {
                            $retval[] = $arr['Name'];
                            $count++;
                        } else {
                            break;
                        }
                    }
                }
            }
        }

        return $retval;
    }

    /**
     * Returns the list of procedures inside this database
     *
     * @param int    $pos          The offset of the list within the results
     * @param string $searchClause A string used to filter the results of the query
     *
     * @return array
     */
    private function _getProcedures($pos, $searchClause)
    {
        return $this->_getRoutines('PROCEDURE', $pos, $searchClause);
    }

    /**
     * Returns the list of functions inside this database
     *
     * @param int    $pos          The offset of the list within the results
     * @param string $searchClause A string used to filter the results of the query
     *
     * @return array
     */
    private function _getFunctions($pos, $searchClause)
    {
        return $this->_getRoutines('FUNCTION', $pos, $searchClause);
    }

    /**
     * Returns the list of events inside this database
     *
     * @param int    $pos          The offset of the list within the results
     * @param string $searchClause A string used to filter the results of the query
     *
     * @return array
     */
    private function _getEvents($pos, $searchClause)
    {
        $maxItems = $GLOBALS['cfg']['MaxNavigationItems'];
        $retval = array();
        $db = $this->real_name;
        if (!$GLOBALS['cfg']['Server']['DisableIS']) {
            $escdDb = $GLOBALS['dbi']->escapeString($db);
            $query = "SELECT `EVENT_NAME` AS `name` ";
            $query .= "FROM `INFORMATION_SCHEMA`.`EVENTS` ";
            $query .= "WHERE `EVENT_SCHEMA` "
                . Util::getCollateForIS() . "='$escdDb' ";
            if (!empty($searchClause)) {
                $query .= "AND `EVENT_NAME` LIKE '%";
                $query .= $GLOBALS['dbi']->escapeString($searchClause);
                $query .= "%'";
            }
            $query .= "ORDER BY `EVENT_NAME` ASC ";
            $query .= "LIMIT " . intval($pos) . ", $maxItems";
            $retval = $GLOBALS['dbi']->fetchResult($query);
        } else {
            $escdDb = Util::backquote($db);
            $query = "SHOW EVENTS FROM $escdDb ";
            if (!empty($searchClause)) {
                $query .= "WHERE `Name` LIKE '%";
                $query .= $GLOBALS['dbi']->escapeString($searchClause);
                $query .= "%'";
            }
            $handle = $GLOBALS['dbi']->tryQuery($query);
            if ($handle !== false) {
                $count = 0;
                if ($GLOBALS['dbi']->dataSeek($handle, $pos)) {
                    while ($arr = $GLOBALS['dbi']->fetchArray($handle)) {
                        if ($count < $maxItems) {
                            $retval[] = $arr['Name'];
                            $count++;
                        } else {
                            break;
                        }
                    }
                }
            }
        }

        return $retval;
    }

    /**
     * Returns HTML for control buttons displayed infront of a node
     *
     * @return String HTML for control buttons
     */
    public function getHtmlForControlButtons()
    {
        $ret = '';
        $cfgRelation = PMA_getRelationsParam();
        if ($cfgRelation['navwork']) {
            if ($this->hiddenCount > 0) {
                $params = array(
                    'showUnhideDialog' => true,
                    'dbName' => $this->real_name,
                );
                $ret = '<span class="dbItemControls">'
                    . '<a href="navigation.php'
                    . URL::getCommon($params) . '"'
                    . ' class="showUnhide ajax">'
                    . Util::getImage(
                        'show.png',
                        __('Show hidden items')
                    )
                    . '</a></span>';
            }
        }

        return $ret;
    }

    /**
     * Sets the number of hidden items in this database
     *
     * @param int $count hidden item count
     *
     * @return void
     */
    public function setHiddenCount($count)
    {
        $this->hiddenCount = $count;
    }

    /**
     * Returns the number of hidden items in this database
     *
     * @return int hidden item count
     */
    public function getHiddenCount()
    {
        return $this->hiddenCount;
    }
}

                                                                                                                                                                                                                                                                                             ties/visibility/) instead.