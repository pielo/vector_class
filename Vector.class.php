<?php
class Vector
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 0.0;
	private $_origin;
	private $_dest;
	public static $verbose = false;

	function getX() { return $this->_x; }
	function getY() { return $this->_y; }
	function getZ() { return $this->_z; }
	function getW() { return $this->_w; }

	function setX($v) { $this->_x = $v; }
	function setY($v) { $this->_y = $v; }
	function setZ($v) { $this->_z = $v; }
	function setW($v) { $this->_w = $v; }

	public static function doc()
	{
		$file = file_get_contents("Vector.doc.txt");
        return $file;
	}

	function __construct(array $kwargs)
	{
		$this->_dest = clone $kwargs['dest'];
		if (array_key_exists('orig', $kwargs))
			$this->_origin = clone $kwargs['orig'];
		else
			$this->_origin = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1));
		$this->_x = $this->_dest->getX() - $this->_origin->getX();
		$this->_y = $this->_dest->getY() - $this->_origin->getY();
		$this->_z = $this->_dest->getZ() - $this->_origin->getZ();
		if (self::$verbose == true)
			printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
	}

	function __destruct()
	{
			printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
	}

	public function __toString()
	{
		if (self::$verbose == true)
		return (sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->_x, $this->_y, $this->_z, $this->_w));
	}

	function magnitude()
	{
		return (sqrt(($this->_dest->getX() - $this->_origin->getX()) * ($this->_dest->getX() - $this->_origin->getX()) + ($this->_dest->getY() - $this->_origin->getY()) * ($this->_dest->getY() - $this->_origin->getY()) + ($this->_dest->getZ() - $this->_origin->getZ()) * ($this->_dest->getZ() - $this->_origin->getZ())));
	}

	function normalize()
	{
		if (($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z) !== 0)
			$val = 1 / sqrt(($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z));
		$desti = new Vertex( array( 'x' => $this->_x * $val, 'y' => $this->_y * $val, 'z' => $this->_z * $val ) );
		$vec = new Vector(array('dest' => $desti));
		return ($vec);
	}

	function add($rhs)
	{
		$desti = new Vertex( array( 'x' => $this->_x + $rhs->_x, 'y' => $this->_y + $rhs->_y, 'z' => $this->_z + $rhs->_z ) );
		$vec = new Vector(array('dest' => $desti));
		return ($vec);
	}

	function sub($rhs)
    {
        $desti = new Vertex( array( 'x' => $this->_x - $rhs->_x, 'y' => $this->_y - $rhs->_y, 'z' => $this->_z - $rhs->_z ) );
        $vec = new Vector(array('dest' => $desti));
        return ($vec);
	}

	function opposite()
	{
		$desti = new Vertex( array( 'x' => $this->_x * -1, 'y' => $this->_y * -1, 'z' => $this->_z * -1 ) );
        $vec = new Vector(array('dest' => $desti));
        return ($vec);
	}

	function scalarProduct($scal)
	{
		$desti = new Vertex( array( 'x' => $this->_x * $scal, 'y' => $this->_y * $scal, 'z' => $this->_z * $scal ) );
        $vec = new Vector(array('dest' => $desti));
        return ($vec);
	}

	function dotProduct($rhs)
	{
		$val = $this->_x * $rhs->_x + $this->_y * $rhs->_y + $this->_z * $rhs->_z;
		return ($val);
	}

	function cos($rhs)
	{
		$val = ($this->_x * $rhs->_x + $this->_y * $rhs->_y + $this->_z * $rhs->_z) / sqrt(($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z) * ($rhs->_x * $rhs->_x + $rhs->_y * $rhs->_y + $rhs->_z * $rhs->_z));
		return ($val);
	}

	function crossProduct($rhs)
	{
		$desti = new Vertex( array( 'x' => $this->_y * $rhs->_z - $this->_z * $rhs->_y, 'y' => $this->_z * $rhs->_x - $this->_x * $rhs->_z, 'z' => $this->_x * $rhs->_y - $this->_y * $rhs->_x ) );
        $vec = new Vector(array('dest' => $desti));
        return ($vec);
	}
}
?>
