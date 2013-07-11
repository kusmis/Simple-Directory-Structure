<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
array_push($this->_sorted, $this->_smallest);
           $params[$pos] = '';
           for($start = $pos; $start < sizeof($params); $start++) {
               $params[$start] = $params[$start+1];
           }
           unset($params[sizeof($params)-1]);
           $this->_getSorting($params);
?>
