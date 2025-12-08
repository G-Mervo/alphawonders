    if (! empty($searchClause)) {
                $query .= "AND " . $this->_getWhereClauseForSearch(
                    $searchClause,
                    $singleItem,
                    'TABLE_NAME'
                );
            }
            $retval = (int)$GLOBALS['dbi']->fetchValue($query);
        } else {
            $query = "SHOW FULL TABLES FROM ";
            $query .= Util::backquote($db);
            $query .= " WHERE `Table_type`" . $condition . "'BASE TABLE' ";
            if (!empty($searchClause)) {
                $query .= "AND " . $this->_getWhereClauseForSearch(
                    $searchClause,
                    $singleItem,
                    'Tables_in_' . $db
                );
            }
            $retval = $GLOBALS['dbi']->numRows(
                $GLOBALS['dbi']->tryQuery($query)
            );
        }

        return $retval;
    }

    /**
     * Returns the number of tables present inside this database
     *
     * @param string  $searchClause A string used to filter the results of
     *                              the query
     * @param boolean $singleItem   Whether to get presence of a single known
     *                              item or false in none
     *
     * @return int
     */
    private function _getTableCount($searchClause, $singleItem)
    {
