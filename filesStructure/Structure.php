<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Structure
 *
 * @author kushagra
 */
class Structure extends filesDb {

    //put your code here
    private $ref;
    private $_smallest;
    private $_sorted;
    private $_length;
    private $_structure;
    private $_glob;
    private $_pos;
    private $_lastGlob;

    public function __construct() {
        $this->smallest = null;
        $this->_sorted = array();
        $this->_structure = '';
        $this->_dirCount = '';
    }

    public function __create($ref) {
        $children = $this->_getChild($ref);
        if (!isset($this->_glob)) {
            foreach ($children as $child) {
                $this->_glob[] = $child['id'];
            }
        }

        while (!empty($children) && !empty($this->_glob)) {
            $this->_getSmallest($children);
            if (in_array($this->_smallest['id'], $this->_glob)) {
                echo "<ul><li><a href='#' selfref='" . $this->_smallest['id'] . "'>" . $this->_smallest['name'] . "</a>";
                $children = $this->_normalize($children);
                $this->_lastGlob = $this->_smallest['id'];
                $this->_globPrepare($this->_smallest['id']);
                $this->__create($this->_smallest['id']);
            } else {
                echo "</li></ul>";
                break;
            }
        }
        if (empty($children)) {
            echo "</li></ul>";
        }
    }

    private function _globPrepare($id = "") {
        $tempPos = $this->_pos;
        foreach ($this->_glob as $key => $value) {
            if ($id == $value) {
                $this->_pos = $key;
                break;
            }
        }
        $this->_glob = $this->_normalize($this->_glob);
        $this->_pos = $tempPos;
    }

    private function _getChild($ref) {
        $sql = "select * from folders where parent REGEXP '(^$ref,)|(, $ref$)|(, $ref,)'";
        $query = mysql_query($sql);
        $children = $this->_sqlToArray($query);
        return $children;
    }

    private function _getSmallest($params) {
        $this->_smallest = $params[0];
        $this->_length = strlen($this->_smallest['parent']);
        $pos = 0;
        if (sizeof($params) > 1) {
            foreach ($params as $key => $param) {
                if (strlen($param['parent']) < $this->_length) {
                    $this->_length = strlen($param['parent']);
                    $pos = $key;
                    $this->_smallest = $params[$pos];
                    $this->_pos = $pos;
                } else {
                    $this->_smallest = $params[$pos];
                    $this->_pos = $pos;
                }
            }
        } else {
            $this->_pos = $pos;
            $this->_smallest = $params[$pos];
        }
    }

    private function _normalize($params) {
        $pos = $this->_pos;
        $params[$pos] = '';
        for ($start = $pos; $start < sizeof($params); $start++) {
            $params[$start] = $params[$start + 1];
        }
        unset($params[sizeof($params) - 1]);
        return $params;
    }

}

?>
