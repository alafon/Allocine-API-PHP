<?php

/**
 * Object represention of a query made with Allocine API
 *
 * @copyright Arnaud Lafon
 *
 * global paramters
 *
 * @property string     $method    Method to be called : search, movie
 * @property string     $partnerid Partner id
 * @property string     $format    [optional] Result format to expext (xml,json)
 *
 *
 * search specific parameters
 *
 * @property string     $q         Query
 * @property array      $filter    [optional] Array of filters (movie,theater,person,news,tvseries)
 * @property integer    $count     [optional] Limit results number
 * @property integer    $page      [optional] Offset if limiting results
 *
 * movie specific parameters
 *
 * @property string     $code      Movie id
 * @property string     $profile   [optional] amount of data returned (small,medium,large)
 * @property string     $mediafmt  [optional] video format (flv,mp4-lc,mp4-hip,mp4-archive,mpeg2-theater,mpeg2
 * @property string     $striptags [optional] strip html tags passed as arguments ???
 *
 */
class AllocineQuery
{
    public function __construct( $partnerid )
    {
        $this->partnerid = $partnerid;
    }

    public function __get( $key )
    {
        return $this->$key;
    }

    public function __set( $key, $value )
    {
        $this->$key = $value;
    }

    public function queryString()
    {
        $queryString = "/{$this->method}?";
        $objectVar = get_object_vars( $this );

        $queryArray = array();
        foreach( $objectVar as $key => $value )
        {
            if( $key == 'method' ) continue;
            $queryArray[] = "{$key}=" . urlencode( $value );
        }
        return $queryString . implode( "&", $queryArray );
    }

}

?>
