<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$filesObj = new filesDb();
$rootFolders = $filesObj->select(array(
    "cnd" => "parent = '0'"
        ));

if (!empty($rootFolders)) {
    foreach ($rootFolders as $rootFolder) {
        $struct = new Structure();
        echo "<ul><li><a href='#' selfref='" . $rootFolder['id'] . "'>" . $rootFolder['name'] . "</a>";
        echo $struct->__create($rootFolder['id']);
        echo "</li></ul>";
        echo "</li></ul>";
    }
}
?>
