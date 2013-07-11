<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of filesDb
 *
 * @author kushagra
 */
class filesDb {

    //put your code here
    private $_rowcount;
    public function __construct($params = '') {
        mysql_connect("localhost", "root", "") or die("cannot connect");
        mysql_select_db("wiplash") or die("cannot select");
        if($params != '') {
           $this->_save($params);   
        }
    }

    private function _save($params) {
        if ($params['id'] == '0') {
            $sql = "insert into folders(name, parent) values('" . $params['name'] . "', '0')";
            $query = mysql_query($sql) or die("cannot execute ");
            echo mysql_insert_id();
        } else {
            $select = mysql_query("select * from folders where id = " . $params['id']);
            $result = mysql_fetch_array($select);
            $parent = $result['parent'] . ", " . $params['id'];
            $sql = "insert into folders(name, parent) values('" . $params['name'] . "', '{$parent}')";
            $query = mysql_query($sql) or die("cannot execute");
            echo mysql_insert_id();
        }
    }

    public function select( $params ) {
        $sql = "select ";
        if(isset($params['cols'])) {
            foreach( $params['cols'] as $cols ) {
                $sql.="$cols, ";
            }
            $sql = substr($sql,0,strlen($sql)-2);
        }
        else {
            $sql.="*";
        }
        if(isset($params['tab'])) {
            $sql.=" from ".$params['tab']; 
        }
        else {
            $sql.=" from folders";
        }
        if(isset($params['cnd'])) {
            $sql.=" where ".$params['cnd'];
        }
        $query = mysql_query($sql);
        $rows = $this->_sqlToArray($query);
        if($this->_rowcount > 0) {
            return $rows;
        } 
        else {
            return array();
        }
    }
    protected function _sqlToArray( $resultset ) {
        $_resultArray = array();
        $count = 0;
        while( $row = mysql_fetch_array($resultset) ) {
            array_push($_resultArray,$row);
            $count++;
        }
        $this->_rowcount = $count;
        return $_resultArray;
    }

}
if(!empty($_POST)) {
    new filesDb($_POST);    
}
?>
