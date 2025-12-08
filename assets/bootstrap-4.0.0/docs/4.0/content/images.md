 */
    private function _getFunctionCount($searchClause, $singleItem)
    {
        $db = $this->real_name;
        if (!$GLOBALS['cfg']['Server']['DisableIS']) {
            $db = $GLOBALS['dbi']->escapeString($db);
            $query = "SELECT COUNT(*) ";
            $query .= "FROM `INFORMATION_SCHEMA`.`ROUTINES` ";
            $query .= "WHERE `ROUTINE_SCHEMA` "
                . Util::getCollateForIS() . "='$db' ";
            $query .= "AND `ROUTINE_TYPE`='FUNCTION' ";
            if (!empty($searchClause)) {
                $query .= "AND " . $this->_getWhereClauseForSearch(
                    $searchClause,
                    $singleItem,
                    'ROUTINE_NAME'
                );
            }
            $retval = (int)$GLOBALS['dbi']->fetchValue($query);
        } else {
            $db = $GLOBALS['dbi']->escapeString($db);
            $query = "SHOW FUNCTION STATUS WHERE `Db`='$db' ";
            if (!empty($searchClause)) {
                $query .= "AND " . $this->_getWhereClauseForSearch(
                    $searchClause,
                    $singleItem,
                    'Name'
                );
            }
            $retval = $GLOBALS['dbi']->numRows(
                $GLOBALS['dbi']->tryQuery($query)
            );
        }

        return $retval;
    }

    /**
     * Returns the number of events present inside this database
     *
     * @param string  $searchClause A string used to filter the results of
     *                              the query
     * @param boolean $singleItem   Whether to get presence of a single known
     *                              item or false in none
     *
     * @return int
     */
    private function _getEventCount($searchClause, $singleItem)
    {
        $db = $this->real_name;
        if (!$GLOBALS['cfg']['Server']['DisableIS']) {
            $db = $GLOBALS['dbi']->escapeString($db);
            $query = "SELECT COUNT(*) ";
            $query .= "FROM `INFORMATION_SCHEMA`.`EVENTS` ";
            $query .= "WHERE `EVENT_SCHEMA` "
                . Util::getCollateForIS() . "='$db' ";
            if (!empty($searchClause)) {
                $query .= "AND " . $this->_getWhereClauseForSearch(
                    $searchClause,
                    $singleItem,
                    'EVENT_NAME'
                );
            }
            $retval = (int)$GLOBALS['dbi']->fetchValue($query);
        } else {
            $db = Util::backquote($db);
            $query = "SHOW EVENTS FROM $db ";
            if (!empty($searchClause)) {
                $query .= "WHERE " . $this->_getWhereClauseForSearch(
                    $searchClause,
                    $singleItem,
                    'Name'
                );
            }
            $retval = $GLOBALS['dbi']->numRows(
                $GLOBALS['dbi']->tryQuery($query)
            );
        }

        return $retval;
    }

    /**
     * Returns the WHERE clause for searching inside a database
     *
     * @param string  $searchClause A string used to filter the results of the query
     * @param boolean $singleItem   Whether to get presence of a single known item
     * @param string  $columnName   Name of the column in the result set to match
     *
     * @return string WHERE clause for searching
     */
    private function _getWhereClauseForSearch(
    