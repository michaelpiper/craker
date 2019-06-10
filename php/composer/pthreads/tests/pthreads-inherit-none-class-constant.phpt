--TEST--
Class constant in PTHREADS_INHERIT_NONE thread
--DESCRIPTION--
This test ensures that class constants are available inside in PTHREADS_INHERIT_NONE threads without error.
--FILE--
<?php
class testClass extends \Thread {

    const TEST_CONSTANT=0x00;

    public function run() {
        var_dump('works');
    }
}

$x = new testClass();
$x->start(PTHREADS_INHERIT_NONE);
$x->join();
--EXPECT--
string(5) "works"
