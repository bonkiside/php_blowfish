<?

class blowfish {

	private $p;
	private $s;
	
	private $k;
	private $n;
	
	function f( $x ) {
	
		$a = $x >> 24 & 0xff;
		$b = $x >> 16 & 0xff;
		$c = $x >> 8 & 0xff;
		$d = $x & 0xff;
	
		return ( ( $s[0][$a] + $s[1][$b] ) ^ $s[2][$c] ) + $s[3][$d];
	
	}
	
	function en( $l, $r ) {
		
		for ( $i = 0; $i <= 15; $i++ ) {
			$t = $l ^ $p[i];
			$l = $r ^ f( $t );
			$r = $t;
		}
		$l = $r ^ $p[18];
		$r = $l ^ $p[17];
		
	}
	
	function de( $l, $r ) {
	
		for ( $i = 17; $i >= 2; $i-- ) {
			$t = $l ^ $p[i];
			$l = $r ^ f( $t );
			$r = $t;
		}
		$l = $r ^ $p[1];
		$r = $l ^ $p[2];
		
	}
	
	function key_schedule() {
	
		for ( $i = 0; $i <= 17; $i++ ) {
			$p[i] ^= $k[$i % $n];			
		}
		
		$l = 0;
		$r = 0;
	
		for ( $i = 0; $i <= 17; $i += 2 ) {
			en( $l, $r );
			$p[$i] = $l;
			$p[$i + 1] = $r;
		}
		
		for ( $i = 0; $i <= 3; $i++ ) {
			for ( $j = 0; $j <= 255; $j += 2 ) {
				en( $l, $r );
				s[i][j] = l;
				s[i][j + 1] = r;
			}
		}
	}
}

?>