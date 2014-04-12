<?php
class Color
{
	public $red = 0;
	public $green = 0;
	public $blue = 0;
	public static $verbose = False;

	public static function doc()
	{
		$file = file_get_contents("Color.doc.txt");
		return $file;
	}

	function __construct(array $kwargs)
	{
		if (array_key_exists('rgb', $kwargs))
		{
			$this->red = $kwargs['rgb'] % 256;
			if ($this->red > 255)
            	$this->red = 255;
        	if ($this->red < 0)
            	$this->red = 0;
			$this->green = ($kwargs['rgb'] / 256) % 256;
			if ($this->green > 255)
            	$this->green = 255;
        	if ($this->green < 0)
            	$this->green = 0;
			$this->blue = ($kwargs['rgb'] / 65536) % 256;
			if ($this->blue > 255)
            	$this->blue = 255;
        	if ($this->blue < 0)
            	$this->blue = 0;
		}
		else if (array_key_exists('red', $kwargs) and array_key_exists('green', $kwargs) and array_key_exists('blue', $kwargs))
		{
			$this->red = $kwargs['red'];
			if ($this->red > 255)
            	$this->red = 255;
        	if ($this->red < 0)
            	$this->red = 0;
			$this->green = $kwargs['green'];
			if ($this->green > 255)
            	$this->green = 255;
        	if ($this->green < 0)
            	$this->green = 0;
			$this->blue = $kwargs['blue'];
			if ($this->blue > 255)
            	$this->blue = 255;
        	if ($this->blue < 0)
            	$this->blue = 0;
		}
		else
			print('Wrong args' .PHP_EOL);
		if (self::$verbose == True)
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
		return ;
	}

	function __destruct()
	{
		if (self::$verbose == True)
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
	}

	public function __toString()
	{
		return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue));
	}

	public function add( $inst )
	{
		$str = new Color(array( 'red' => $this->red + $inst->red, 'green' => $this->green + $inst->green, 'blue' => $this->blue + $inst->blue));
		return $str;
	}

	public function sub( $inst )
    {
		$str = new Color(array( 'red' => $this->red - $inst->red, 'green' => $this->green - $inst->green, 'blue' => $this->blue - $inst->blue));
        return $str;
	}

	public function mult( $val )
    {
		$str = new Color(array( 'red' => $val * $this->red, 'green' => $val * $this->green, 'blue' => $val * $this->blue));
        return $str;
    }
}
?>
