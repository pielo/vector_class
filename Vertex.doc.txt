<?php
class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 1.0;
	private $_color;
	public static $verbose = false;

	function getX() { return $this->_x; }
	function getY() { return $this->_y; }
	function getZ() { return $this->_z; }
	function getW() { return $this->_w; }
	function getColor() { return $this->_color; }

	function setX($v) { $this->_x = $v; }
	function setY($v) { $this->_y = $v; }
	function setZ($v) { $this->_z = $v; }
	function setW($v) { $this->_w = $v; }
	function setColor($v) { $this->_color = clone $v; }
	
	public static function doc()
	{
		$file = file_get_contents("Vertex.doc.txt");
        return $file;
	}

	function __construct(array $kwargs)
	{
		$this->_x = $kwargs['x'];
		$this->_y = $kwargs['y'];
		$this->_z = $kwargs['z'];
		if (array_key_exists('w', $kwargs))
			$this->_w = $kwargs['w'];
		if (array_key_exists('color', $kwargs))
			$this->_color = clone $kwargs['color'];
		else
			$this->_color = new Color( array('red' => 0xff, 'green' => 0xff, 'blue' => 0xff) );
		if (self::$verbose == true)
			printf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
	}

	function __destruct ()
	{
		if (self::$verbose == true)
            printf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, Color( red: %3d, green: %3d, blue: %3d ) ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
	}

	public function __toString()
	{
		if (self::$verbose == true)
			return (sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, Color( red: %3d, green: %3d, blue: %3d ) )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue));
		else
			return (sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f )", $this->_x, $this->_y, $this->_z, $this->_w));
	}
}
?>
