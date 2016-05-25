<?php

class VCode
{
    private $code;
    private $list;

    public function __construct()
    {
        $seeds = explode("\n", file_get_contents('vcode_seed.txt'));
        $seed = $seeds[array_rand($seeds)];

        $chars = preg_split('/(?<!^)(?!$)/u', $seed);
        for ($n = 3; $n--; shuffle($chars)) {
            $this->list [] = join('', $chars);
        }

        $this->code = $seed;
        $this->list [] = $seed;

        shuffle($this->list);
    }

    /**
     * @param $name $(form input[name])
     * @return string
     */
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
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

}
