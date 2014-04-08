<?php

class ibase {
    public $dbSettings = null; // store settings like user, pass, host
    public $connectId = null;
    public $query = null;
    public $result = null; //id of query
    public $fetched = null; // fetched data
    public $fetchedLen = 0; // number of fetched rows
    public $trans = null;

    function __construct(){
        include_once('lib/YamlConfig.php');
        $config = YamlConfig('config');

        $this->dbSettings = $config['dbsettings'];
    }

    function dbconnect($trans = false){
        $dbinfo = $this->dbSettings;
        if ( $con =  ibase_connect($dbinfo['host'], $dbinfo['user'], $dbinfo['pass'], 'UTF8') ){
            $this->connectId =  $con;
            if ( $trans )
                $this->trans = ibase_trans();

            return true;
        }
        else {
            return false;
        }
    }

    function disconnect(){
        if ( $this->connectId != null )
            ibase_close( $this->connectId );
    }

    function query($query){
        if ( $this->trans ) $id = $this->trans;
        else $id = $this->connectId;

        $this->query = $query;

        if ( $res = ibase_query( $id, $query ) ){
            $this->result = $res;

            return true;
        }
        else {
            $this->result = false;
            return false;
        }
    }

    // $method - assoc, row, object (default='assoc')
    // optional 2nd parameter, when exist function sends query to database
    function fetch($method = 'assoc', $sql = false){
        if ($sql)
            $this->query($sql);

        if ($this->result){
            $funcName = null;
            switch ($method){
                case 'assoc':
                    $funcName = 'ibase_fetch_assoc';
                    break;
                case 'row':
                    $funcName = 'ibase_fetch_row';
                    break;
                case 'obj':
                    $funcName = 'ibase_fetch_object';
                    break;
                default:
                    $funcName = 'ibase_fetch_assoc';
            }

            $temp = array();
            $counter = 0;
            while( $row = $funcName( $this->result ) ){
                $temp[$counter] = $row;
                $counter++;
            }
            if ($temp) {
              $this->fetched = $temp;
            }
            else {
              $this->fetched = array();
            }
            $this->fetchedLen = $counter+1;
        }
        return $this->fetched;
    }

    function genValue($genName){
        return ibase_gen_id($genName);
    }

    function freeResult(){
        ibase_free_result( $this->result );
    }

    function commit(){
        if ( $this->trans )
            ibase_commit($this->trans);
    }
}