<?php
function get_usage_in_kb(){
    echo memory_get_usage()/1024.0 . " kb \n";
}

class Profiler
{
    protected $startTime = 0;
    public function timerStart(){
        $this->startTime = microtime(true);
    }

    function timerEnd(){
        echo number_format( (microtime(true) - $this->startTime)*1000, 2 ), ' ms';
    }
}

class ProfilerHolder {
    protected $profiler;

    public function __construct( Profiler $profiler ){
        $this->profiler = $profiler;
    }
}

ini_set('memory_limit', '1M');

$profiler = new Profiler();

$profiler->timerStart();

get_usage_in_kb();

$holder = new ProfilerHolder( $profiler );

$b = null;

/**
 * @return string
 */
function make_dummy_data()
{
    return str_repeat( "Hello|", 114242 );
}

$a = make_dummy_data();

$data = explode( '|', $a ); // comment this after narrowing down that a lot of memory is being used here
//$data = array(); // uncomment this and memory usage will drop

$buffer = array();

foreach( $data as $key => $item ){
    $buffer[] = $item;
}

get_usage_in_kb();

unset($a);

get_usage_in_kb();

echo memory_get_peak_usage(TRUE)/1024, ' kb', "\n";

$profiler->timerEnd();

unset( $profiler );
xdebug_debug_zval( 'profiler' );

//var_dump( $holder );