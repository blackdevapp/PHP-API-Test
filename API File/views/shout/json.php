<?php
/**
 * Create a simple jason output with json header so it can be more easy to clients to undrestand result
 */
header('Content-Type: application/json;charset=utf-8');
// header( "Content-Type: text/html; ");
echo json_encode($result);