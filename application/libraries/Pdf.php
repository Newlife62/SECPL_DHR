<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('fpdf.php');
class Pdf extends FPDF 
{
  // Extend FPDF using this class
  // More at fpdf.org -> Tutorials
    protected $T128;                                         // Tableau des codes 128
protected $ABCset = "";                                  // jeu des caract�res �ligibles au C128
protected $Aset = "";                                    // Set A du jeu des caract�res �ligibles
protected $Bset = "";                                    // Set B du jeu des caract�res �ligibles
protected $Cset = "";                                    // Set C du jeu des caract�res �ligibles
protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Caract�res de s�lection de jeu au d�but du C128
protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // Caract�res de changement de jeu
protected $FontSpacingPt;      // current font spacing in points
protected $FontSpacing;        // current font spacing in user units

var $angle=0;

function Rotate($angle,$x=-1,$y=-1)
{
    if($x==-1)
        $x=$this->x;
    if($y==-1)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
}

function _endpage()
{
    if($this->angle!=0)
    {
        $this->angle=0;
        $this->_out('Q');
    }
    parent::_endpage();
}


function SetFontSpacing($size)
{
    if($this->FontSpacingPt==$size)
        return;
    $this->FontSpacingPt = $size;
    $this->FontSpacing = $size/$this->k;
    if ($this->page>0)
        $this->_out(sprintf('BT %.3f Tc ET', $size));
}

protected function _dounderline($x, $y, $txt)
{
    // Underline text
    $up = $this->CurrentFont['up'];
    $ut = $this->CurrentFont['ut'];
    $w = $this->GetStringWidth($txt)+$this->ws*substr_count($txt,' ')+(strlen($txt)-1)*$this->FontSpacing;
    return sprintf('%.2F %.2F %.2F %.2F re f',$x*$this->k,($this->h-($y-$up/1000*$this->FontSize))*$this->k,$w*$this->k,-$ut/1000*$this->FontSizePt);
}

  function __construct($orientation='P', $unit='mm', $size='A4')
  {
    // Call parent constructor
    parent::__construct($orientation,$unit,$size);
    
    $this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caract�res
	$this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
	$this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
	$this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
	$this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
	$this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
	$this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
	$this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
	$this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
	$this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
	$this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
	$this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
	$this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
	$this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
	$this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
	$this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
	$this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
	$this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
	$this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
	$this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
	$this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
	$this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
	$this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
	$this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
	$this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
	$this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
	$this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
	$this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
	$this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
	$this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
	$this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
	$this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
	$this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
	$this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
	$this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
	$this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
	$this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
	$this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
	$this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
	$this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
	$this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
	$this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
	$this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
	$this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
	$this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
	$this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
	$this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
	$this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
	$this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
	$this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
	$this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
	$this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
	$this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
	$this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
	$this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
	$this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
	$this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
	$this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
	$this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
	$this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
	$this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
	$this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
	$this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
	$this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
	$this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
	$this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
	$this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
	$this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
	$this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
	$this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
	$this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
	$this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
	$this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
	$this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
	$this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
	$this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
	$this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
	$this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
	$this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
	$this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
	$this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
	$this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
	$this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
	$this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
	$this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
	$this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
	$this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
	$this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
	$this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
	$this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
	$this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
	$this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
	$this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
	$this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
	$this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
	$this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
	$this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
	$this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
	$this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
	$this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
	$this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]                
	$this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
	$this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
	$this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
	$this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
	$this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
	$this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
	$this->T128[] = array(2, 1);                       //107 : [END BAR]

	for ($i = 32; $i <= 95; $i++) {                                            // jeux de caract�res
		$this->ABCset .= chr($i);
	}
	$this->Aset = $this->ABCset;
	$this->Bset = $this->ABCset;
	
	for ($i = 0; $i <= 31; $i++) {
		$this->ABCset .= chr($i);
		$this->Aset .= chr($i);
	}
	for ($i = 96; $i <= 127; $i++) {
		$this->ABCset .= chr($i);
		$this->Bset .= chr($i);
	}
	for ($i = 200; $i <= 210; $i++) {                                           // controle 128
		$this->ABCset .= chr($i);
		$this->Aset .= chr($i);
		$this->Bset .= chr($i);
	}
	$this->Cset="0123456789".chr(206);

	for ($i=0; $i<96; $i++) {                                                   // convertisseurs des jeux A & B
		@$this->SetFrom["A"] .= chr($i);
		@$this->SetFrom["B"] .= chr($i + 32);
		@$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
		@$this->SetTo["B"] .= chr($i);
	}
	for ($i=96; $i<107; $i++) {                                                 // contr�le des jeux A & B
		@$this->SetFrom["A"] .= chr($i + 104);
		@$this->SetFrom["B"] .= chr($i + 104);
		@$this->SetTo["A"] .= chr($i);
		@$this->SetTo["B"] .= chr($i);
	}
  }
  function Code128($x, $y, $code, $w, $h) {
	$Aguid = "";                                                                      // Cr�ation des guides de choix ABC
	$Bguid = "";
	$Cguid = "";
	for ($i=0; $i < strlen($code); $i++) {
		$needle = substr($code,$i,1);
		$Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O"); 
		$Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O"); 
		$Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
	}

	$SminiC = "OOOO";
	$IminiC = 4;

	$crypt = "";
	while ($code > "") {
                                                                                    // BOUCLE PRINCIPALE DE CODAGE
		$i = strpos($Cguid,$SminiC);                                                // for�age du jeu C, si possible
		if ($i!==false) {
			$Aguid [$i] = "N";
			$Bguid [$i] = "N";
		}

		if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // jeu C
			$crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // d�but Cstart, sinon Cswap
			$made = strpos($Cguid,"N");                                             // �tendu du set C
			if ($made === false) {
				$made = strlen($Cguid);
			}
			if (fmod($made,2)==1) {
				$made--;                                                            // seulement un nombre pair
			}
			for ($i=0; $i < $made; $i += 2) {
				$crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 par 2
			}
			$jeu = "C";
		} else {
			$madeA = strpos($Aguid,"N");                                            // �tendu du set A
			if ($madeA === false) {
				$madeA = strlen($Aguid);
			}
			$madeB = strpos($Bguid,"N");                                            // �tendu du set B
			if ($madeB === false) {
				$madeB = strlen($Bguid);
			}
			$made = (($madeA < $madeB) ? $madeB : $madeA );                         // �tendu trait�e
			$jeu = (($madeA < $madeB) ? "B" : "A" );                                // Jeu en cours

			$crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // d�but start, sinon swap

			$crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu

		}
		$code = substr($code,$made);                                           // raccourcir l�gende et guides de la zone trait�e
		$Aguid = substr($Aguid,$made);
		$Bguid = substr($Bguid,$made);
		$Cguid = substr($Cguid,$made);
	}                                                                          // FIN BOUCLE PRINCIPALE

	$check = ord($crypt[0]);                                                   // calcul de la somme de contr�le
	for ($i=0; $i<strlen($crypt); $i++) {
		$check += (ord($crypt[$i]) * $i);
	}
	$check %= 103;

	$crypt .= chr($check) . chr(106) . chr(107);                               // Chaine crypt�e compl�te

	$i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
	$modul = $w/$i;

	for ($i=0; $i<strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
		$c = $this->T128[ord($crypt[$i])];
		for ($j=0; $j<count($c); $j++) {
			$this->Rect($x,$y,$c[$j]*$modul,$h,"F");
			$x += ($c[$j++]+$c[$j])*$modul;
		}
	}
}
function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        if (strpos($corners, '2')===false)
            $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        if (strpos($corners, '3')===false)
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        if (strpos($corners, '4')===false)
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        if (strpos($corners, '1')===false)
        {
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
            $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }
    function convert_number_to_words($number) {

                $hyphen = '-';
                $conjunction = ' and ';
                $separator = ', ';
                $negative = 'negative ';
                $decimal = ' point ';
                $dictionary = array(
                    0 => 'Zero',
                    1 => 'One',
                    2 => 'Two',
                    3 => 'Three',
                    4 => 'Four',
                    5 => 'Five',
                    6 => 'Six',
                    7 => 'Seven',
                    8 => 'Eight',
                    9 => 'Nine',
                    10 => 'Ten',
                    11 => 'Eleven',
                    12 => 'Twelve',
                    13 => 'Thirteen',
                    14 => 'Fourteen',
                    15 => 'Fifteen',
                    16 => 'Sixteen',
                    17 => 'Seventeen',
                    18 => 'Eighteen',
                    19 => 'Nineteen',
                    20 => 'Twenty',
                    30 => 'Thirty',
                    40 => 'Fourty',
                    50 => 'Fifty',
                    60 => 'Sixty',
                    70 => 'Seventy',
                    80 => 'Eighty',
                    90 => 'Ninety',
                    100 => 'Hundred',
                    1000 => 'Thousand',
                    100000 => 'Lak',
                    1000000 => 'Million',
                    1000000000 => 'Billion',
                    1000000000000 => 'Trillion',
                    1000000000000000 => 'Quadrillion',
                    1000000000000000000 => 'Quintillion'
                );

                if (!is_numeric($number)) {
                    return false;
                }

                if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
                    // overflow
                    trigger_error(
                            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
                    );
                    return false;
                }

                if ($number < 0) {
                    return $negative . $this->convert_number_to_words(abs($number));
                }

                $string = $fraction = null;

                if (strpos($number, '.') !== false) {
                    list($number, $fraction) = explode('.', $number);
                }

                switch (true) {
                    case $number < 21:
                        $string = $dictionary[$number];
                        break;
                    case $number < 100:
                        $tens = ((int) ($number / 10)) * 10;
                        $units = $number % 10;
                        $string = $dictionary[$tens];
                        if ($units) {
                            $string .= $hyphen . $dictionary[$units];
                        }
                        break;
                    case $number < 1000:
                        $hundreds = $number / 100;
                        $remainder = $number % 100;
                        $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                        if ($remainder) {
                            $string .= $conjunction . $this->convert_number_to_words($remainder);
                        }
                        break;
                    default:
                        $baseUnit = pow(1000, floor(log($number, 1000)));
                        $numBaseUnits = (int) ($number / $baseUnit);
                        $remainder = $number % $baseUnit;
                        $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                        if ($remainder) {
                            $string .= $remainder < 100 ? $conjunction : $separator;
                            $string .= $this->convert_number_to_words($remainder);
                        }
                        break;
                }

                if (null !== $fraction && is_numeric($fraction)) {
                    $string .= $decimal;
                    $words = array();
                    foreach (str_split((string) $fraction) as $number) {
                        $words[] = $dictionary[$number];
                    }
                    $string .= implode(' ', $words);
                }

                return $string;
            }
            
            
            function ClippingText($x, $y, $txt, $outline=false)
    {
        $op=$outline ? 5 : 7;
        $this->_out(sprintf('q BT %.2F %.2F Td %d Tr (%s) Tj ET',
            $x*$this->k,
            ($this->h-$y)*$this->k,
            $op,
            $this->_escape($txt)));
    }

    function ClippingRect($x, $y, $w, $h, $outline=false)
    {
        $op=$outline ? 'S' : 'n';
        $this->_out(sprintf('q %.2F %.2F %.2F %.2F re W %s',
            $x*$this->k,
            ($this->h-$y)*$this->k,
            $w*$this->k,-$h*$this->k,
            $op));
    }

//    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
//    {
//        $h = $this->h;
//        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
//            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
//    }

    function ClippingRoundedRect($x, $y, $w, $h, $r, $outline=false)
    {
        $k = $this->k;
        $hp = $this->h;
        $op=$outline ? 'S' : 'n';
        $MyArc = 4/3 * (sqrt(2) - 1);

        $this->_out(sprintf('q %.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out(' W '.$op);
    }

    function ClippingEllipse($x, $y, $rx, $ry, $outline=false)
    {
        $op=$outline ? 'S' : 'n';
        $lx=4/3*(M_SQRT2-1)*$rx;
        $ly=4/3*(M_SQRT2-1)*$ry;
        $k=$this->k;
        $h=$this->h;
        $this->_out(sprintf('q %.2F %.2F m %.2F %.2F %.2F %.2F %.2F %.2F c',
            ($x+$rx)*$k,($h-$y)*$k,
            ($x+$rx)*$k,($h-($y-$ly))*$k,
            ($x+$lx)*$k,($h-($y-$ry))*$k,
            $x*$k,($h-($y-$ry))*$k));
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
            ($x-$lx)*$k,($h-($y-$ry))*$k,
            ($x-$rx)*$k,($h-($y-$ly))*$k,
            ($x-$rx)*$k,($h-$y)*$k));
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
            ($x-$rx)*$k,($h-($y+$ly))*$k,
            ($x-$lx)*$k,($h-($y+$ry))*$k,
            $x*$k,($h-($y+$ry))*$k));
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c W %s',
            ($x+$lx)*$k,($h-($y+$ry))*$k,
            ($x+$rx)*$k,($h-($y+$ly))*$k,
            ($x+$rx)*$k,($h-$y)*$k,
            $op));
    }

    function ClippingCircle($x, $y, $r, $outline=false)
    {
        $this->ClippingEllipse($x, $y, $r, $r, $outline);
    }

    function ClippingPolygon($points, $outline=false)
    {
        $op=$outline ? 'S' : 'n';
        $h = $this->h;
        $k = $this->k;
        $points_string = '';
        for($i=0; $i<count($points); $i+=2){
            $points_string .= sprintf('%.2F %.2F', $points[$i]*$k, ($h-$points[$i+1])*$k);
            if($i==0)
                $points_string .= ' m ';
            else
                $points_string .= ' l ';
        }
        $this->_out('q '.$points_string . 'h W '.$op);
    }

    function UnsetClipping()
    {
        $this->_out('Q');
    }

    function ClippedCell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        if($border || $fill || $this->y+$h>$this->PageBreakTrigger)
        {
            $this->Cell($w,$h,'',$border,0,'',$fill);
            $this->x-=$w;
        }
        $this->ClippingRect($this->x,$this->y,$w,$h);
        $this->Cell($w,$h,$txt,'',$ln,$align,false,$link);
        $this->UnsetClipping();
    }
    
    //////////////////////////////////////////fit text to cell////////////////////////////////////////////
    
     //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt)==0?1:$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max(strlen($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,true);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        //Same as calling CellFit directly
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,true);
    }
    
    public $footer_data_by_page = []; // Store footer data per page
    public $header_data_by_page = []; // Store header data per page
   

   

    // Call this in controller before AddPage()
    public function setFooterForNextPage($data)
    {
        $this->footer_data_by_page = $data;
    }
    
    public function setHeaderForNextPage($data)
    {
        $this->header_data_by_page = $data;
    }

    function Footer()
    {
        $this->SetXY(10,-8);
        $this->SetFont('Arial','B',9);
        $this->Cell(280/3, 5, 'Format No:'.$this->footer_data_by_page['format_no'].', Rev.'.$this->footer_data_by_page['rev_no'], 0, 0, 'L');
        $this->Cell(280/3, 5, 'Effective Date '.$this->footer_data_by_page['effective_date'], 0, 0, 'C');
        $this->Cell(280/3, 5, 'Page '.$this->PageNo().' of {nb}', 0, 1, 'R');
    }
    
    function Header(){
        $this->SetXY(10,5);
        $this->SetFont('Arial','B',12);
        $this->Image(LOGO_PATH,20,5,25,10);
        $this->Cell(50,10,'',1,0,'C');
        $this->Cell(227,10,$this->header_data_by_page['title'],1,1,'C');
        $this->SetY($this->GetY()+5); 
    }
    
}
?>