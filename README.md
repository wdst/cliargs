# cliargs

    add($name, $short, $long, $desc, $callback);

    $name - name options
    $short - short option, -s
    $long - long option, --long
    $desc - description for help
    $callback - execute function for option

example usage:

$opt = new args();

$opt->add('one', 't', '', '', function () {
    return 'test' . PHP_EOL;
});

$result = $opt->execute();

----------------

Class test {

    public function __construct()
    {
        $args = new args();

        $args->add('test', 't', '', 'description', [$this, 'test']);
        
        $all = $args->execute();
        $all['one']();
        print_r($all['one']);
        
    }
    
    public function test()
    {
        return 'test';
    }
}