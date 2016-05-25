<?php

class VCode
{
    private $code;
    private $list;

    public function __construct()
    {
        $seeds = explode("\n", file_get_contents('vcode_seed.txt'));
        $seed = $seeds[array_rand($seeds)];

        $rands = preg_split('/(?<!^)(?!$)/u', $seed);
        for ($n = 3; $n--;) {
            shuffle($rands);
            $this->list [] = join('', $rands);
        }
        
        $this->code = $seed;
        $this->list [] = $seed;
        
        shuffle($this->list);
    }

    public function renderHTML($name)
    {
        $output = '';
        foreach ($this->list as $option) {
            $output .= "<div class='checkbox'>
                <label>
                  <input name={$name} type=radio value={$option} required/> {$option}
                </label>
              </div>";
        }
        return $output;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

}
