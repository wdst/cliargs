<?php

namespace wdst\cliargs;

Class Cliargs {
    
    private $option_list = [], $cliarg;

    public function __construct()
    {
        $this->add('help', 'h', 'help', 'this help', [$this, 'helpPrint']);
    }

    /**
     * Adding options
     * 
     * @param type $option_name
     * @param type $short
     * @param type $long
     * @param type $desc
     * @param type $callback
     * @return boolean
     * @throws Exception
     */
    public function add($option_name, $short = null, $long = null, $desc = null, $callback)
    {
        if (empty($option_name)) {
            throw new Exception('Does not add name!');
        }

        if (empty($short) && empty($long)) {
            throw new Exception('Does not add options!');
        }

        $this->option_list[] = [
            'name' => $option_name,
            'short' => $short,
            'long' => $long,
            'desc' => $desc,
            'callback' => $callback,
        ];

        return true;
    }

    /**
     * Return help message
     * @return string
     */
    public function help()
    {
        $text = 'Help about the options and commands:' . PHP_EOL . PHP_EOL;
        foreach ($this->option_list as $val) {
            $short = !empty($val['short']) ? '-' . $val['short'] : $val['short'];
            $long = !empty($val['long']) ? '--' . $val['long'] : $val['long'];
            $comma = !empty($short)&&!empty($long) ? ',' : '';
            $text .= sprintf("%6s%s %6s %26s\n", $short, $comma, $long, $val['desc']);
        }
        return $text . PHP_EOL;
    }
    
    /**
     * Print help message
     * @return void
     */
    public function helpPrint()
    {
        print $this->help();
    }
    
    /**
     * Execute
     * @return array
     */
    public function execute()
    {
        $short = '';
        foreach ($this->option_list as $val) {
            $short .= $val['short'] . "::";
        }
        $long = [];
        foreach ($this->option_list as $val) {
            $long[] = $val['long'] . "::";
        }
        $this->cliarg = getopt($short, $long);

        $result = [];
        foreach ($this->cliarg as $k => $v) {

            $key = $this->getArgsItem($k);

            if (!array_key_exists($this->option_list[$key]['name'], $result)) {
                $result[$this->option_list[$key]['name']] = $this->option_list[$key]['callback']();
            }
        }
        return $result;
    }
    
    /**
     * 
     * @param string $args
     * @return string
     */
    private function getArgsItem($args)
    {
        foreach ($this->option_list as $k => $val) {
            if ($val['short'] == $args || $val['long'] == $args) {
                return $k;
            }
        }
    }
}


