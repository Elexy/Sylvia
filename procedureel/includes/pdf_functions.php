<?php
define('FPDF_FONTPATH','fpdf151/font/');
define('DELIVERY_NOTE_ID', -1);
define('PAGE_WIDTH', 179);
define('BW_COLOR', 100);
define('COLOR_COLOR', "0,0,255");

require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/fpdf_protection.php');

class PDF_MC_Table extends FPDF_Protection
{
  var $widths;
  var $aligns;
  var $borders;
  var $rowhight = 5;
  var $bl_tahoma_incl = FALSE;

  function SetWidths($w)
  {
    //Set the array of column widths
    $this->widths=$w;
  }

  function SetHight($h)
  {
    //Set the array of column widths
    $this->rowhight=$h;
  }

  /***********************
 * Add a L for Left    *
 * Add a R for Right   *
 * Add a C for Central *
 ***********************/
  function SetAligns($a)
  {
    //Set the array of column alignments
    $this->aligns=$a;
  }

  /********************
 * Add a D for Draw *
 * Add a F for Fill *
 * Or a DF for both *
 ********************/
  function SetBorders($a)
  {
    //Set the array of cell borders
    $this->borders=$a;
  }

  function Row($data)
  {
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
      $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=$this->rowhight*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
      $w=$this->widths[$i];
      $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
      //Save the current position
      $x=$this->GetX();
      $y=$this->GetY();

      //Draw the border
      if ($this->borders[$i] != '')
      {
        $this->Rect($x,$y,$w,$h,$this->borders[$i]);
      }

      //Print the text
      $this->MultiCell($w,$this->rowhight,$data[$i],0,$a);
      //Put the position to the right of the cell
      $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
  }

  function CheckPageBreak($h)
  {
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
      $this->AddPage($this->CurOrientation);
  }

  function NbLines($w,$txt)
  {
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
      $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
      $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
      $c=$s[$i];
      if($c=="\n")
      {
        $i++;
        $sep=-1;
        $j=$i;
        $l=0;
        $nl++;
        continue;
      }
      if($c==' ')
        $sep=$i;
      $l+=$cw[$c];
      if($l>$wmax)
      {
        if($sep==-1)
        {
          if($i==$j)
            $i++;
        }
        else
          $i=$sep+1;
        $sep=-1;
        $j=$i;
        $l=0;
        $nl++;
      }
      else
        $i++;
    }
    return $nl;
  }

  /**
   * Function     : Code39
   * Draw a Code39 barcode on the given location
   * Input        : xpos, x position
   *                ypos, y position
   *                code, the barcode text to be genereted
   *                baseline, the baseline width
   *                height, the height of the barcode
   *                ratio, the ratio between wide and narrow lines
   **/
  function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5, $ratio = 2)
  {

    $wide = $baseline;
    $narrow = $baseline / $ratio;
    $gap = $baseline;

    $barChar['0'] = 'nnnwwnwnn';
    $barChar['1'] = 'wnnwnnnnw';
    $barChar['2'] = 'nnwwnnnnw';
    $barChar['3'] = 'wnwwnnnnn';
    $barChar['4'] = 'nnnwwnnnw';
    $barChar['5'] = 'wnnwwnnnn';
    $barChar['6'] = 'nnwwwnnnn';
    $barChar['7'] = 'nnnwnnwnw';
    $barChar['8'] = 'wnnwnnwnn';
    $barChar['9'] = 'nnwwnnwnn';
    $barChar['A'] = 'wnnnnwnnw';
    $barChar['B'] = 'nnwnnwnnw';
    $barChar['C'] = 'wnwnnwnnn';
    $barChar['D'] = 'nnnnwwnnw';
    $barChar['E'] = 'wnnnwwnnn';
    $barChar['F'] = 'nnwnwwnnn';
    $barChar['G'] = 'nnnnnwwnw';
    $barChar['H'] = 'wnnnnwwnn';
    $barChar['I'] = 'nnwnnwwnn';
    $barChar['J'] = 'nnnnwwwnn';
    $barChar['K'] = 'wnnnnnnww';
    $barChar['L'] = 'nnwnnnnww';
    $barChar['M'] = 'wnwnnnnwn';
    $barChar['N'] = 'nnnnwnnww';
    $barChar['O'] = 'wnnnwnnwn';
    $barChar['P'] = 'nnwnwnnwn';
    $barChar['Q'] = 'nnnnnnwww';
    $barChar['R'] = 'wnnnnnwwn';
    $barChar['S'] = 'nnwnnnwwn';
    $barChar['T'] = 'nnnnwnwwn';
    $barChar['U'] = 'wwnnnnnnw';
    $barChar['V'] = 'nwwnnnnnw';
    $barChar['W'] = 'wwwnnnnnn';
    $barChar['X'] = 'nwnnwnnnw';
    $barChar['Y'] = 'wwnnwnnnn';
    $barChar['Z'] = 'nwwnwnnnn';
    $barChar['-'] = 'nwnnnnwnw';
    $barChar['.'] = 'wwnnnnwnn';
    $barChar[' '] = 'nwwnnnwnn';
    $barChar['*'] = 'nwnnwnwnn';
    $barChar['$'] = 'nwnwnwnnn';
    $barChar['/'] = 'nwnwnnnwn';
    $barChar['+'] = 'nwnnnwnwn';
    $barChar['%'] = 'nnnwnwnwn';

    $this->SetFont('Arial','',10);
    $this->Text($xpos, $ypos + $height + 4, $code);
    $this->SetFillColor(0);

    $code = '*'.strtoupper($code).'*';
    for($i=0; $i<strlen($code); $i++)
    {
      $char = $code{$i};
      if(!isset($barChar[$char]))
      {
        $this->Error('Invalid character in barcode: '.$char);
      }
      $seq = $barChar[$char];
      for($bar=0; $bar<9; $bar++)
      {
        if($seq{$bar} == 'n')
        {
          $lineWidth = $narrow;
        }else
        {
          $lineWidth = $wide;
        }
        if($bar % 2 == 0)
        {
          $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
        }
        $xpos += $lineWidth;
      }
      $xpos += $gap;
    }
  }

  /**
   * Function     : GetCode128value
   * Get the code 128 value
   * Input        : $str_code: the input code to calculate
   * Returns		: The  value.
   **/
  function GetCode128value($str_code)
  {
    $int_value = $str_code;
    switch ($str_code)
    {
      case 'TB':  $int_value= 100;
        break;
      case 'TA':  $int_value= 101;
        break;
      case 'FN':  $int_value= 102;
        break;
      case 'SA':  $int_value= 103;
        break;
      case 'SB':  $int_value= 104;
        break;
      case 'SC':  $int_value= 105;
        break;
      default:
        $int_value = $str_code;
        break;
    }
    return $int_value;
  }

  /**
   * Function     : CheckChar128
   * Get the code 128c check char.
   * Input        : $str_code: the input code to calculate
   * Returns		: The calulated check char.
   **/
  function CheckChar128($str_code)
  {
    $len = strlen($str_code);
    $sum = $this->GetCode128value(substr($str_code, 0, 2));
    $m = 1;
    for ($i=2;$i<$len;$i+=2)
    {
      $int_value = $this->GetCode128value(substr($str_code, $i, 2));
      $sum += $int_value * $m++;
    }
    $check  = $sum % 103;
    return sprintf("%02d",$check);
  }

  /** Returns <CODE>true</CODE> if the next <CODE>numDigits</CODE>
   * starting from index <CODE>textIndex</CODE> are numeric.
   * @param text the text to check
   * @param textIndex where to check from
   * @param numDigits the number of digits to check
   * @return the check result
   */
  function isNextDigits($text, $textIndex, $numDigits)
  {
    $int_digits = $numDigits;
    $int_strlen = strlen($text);
    $int_index = $textIndex;
    $int_sum = $textIndex + $numDigits;
    if ($int_sum > $int_strlen)
    {
      //echo "<pre>'".substr($text, $int_index, $int_digits). "'</pre>=num NOT OK, sum=$int_sum, $int_index, $int_digits, $int_strlen <br>";
      return false;
    }
    //echo "'".substr($text, $int_index, $int_digits). "', ";
    while ($numDigits-- > 0)
    {
      $c = $text[$textIndex++];
      //echo "'$c',";
      if (!is_numeric($c))
        return false;
    }
    //echo "<pre>'".substr($text, $int_index, $int_digits). "'</pre>=num OK sum=$int_sum, $int_index, $int_digits, $int_strlen <br>";
    return true;
  }

  /** Converts the human readable text to the characters needed to
   * create a barcode. Some optimization is done to get the shortest code.
   * @param text the text to convert
   * @param ucc <CODE>true</CODE> if it is an UCC/EAN-128. In this case
   * @param the code 128 codeing table
   * the character FNC1 is added
   * @return the code ready to be fed to getBarsCode128Raw()
   */
  function getRawText128text($text, $ucc, $code128)
  {
    $out = "";
    $tLen = strlen($text);
    if ($tLen == 0)
    {
      $out .= 'SA';
      if ($ucc)
        $out .= 'FN';
      return $out;
    }
    $c = 0;
    for ($k = 0; $k < $tLen; ++$k)
    {
      $c = ord($text[$k]);
      if ($c > 127)
        $pdf->Text(
        "There are illegal characters for barcode 128 in '"
        . $text
        . "'.");
    }
    $c = ord($text[0]);
    $currentCode = 'SB';
    $index = 0;
    if ($this->isNextDigits($text, $index, 2))
    {
      $currentCode = 'SC';
      $out .= $currentCode;
      if ($ucc)
        $out .= 'FN';
      $out .= substr($text, $index, 2);
      $index += 2;
    } else if ($c < ord(' '))
    {
      $currentCode = 'SA';
      $out .= $currentCode;
      if ($ucc)
        $out .= 'FN';
      $out .= sprintf("%02d", $c + 64);
      ++$index;
    } else
    {
      $out .= $currentCode;
      if ($ucc)
        $out .= 'FN';
      $out .= sprintf("%02d", $c - ord(' '));
      ++$index;
    }
    while ($index < $tLen)
    {
      switch ($currentCode)
      {
        case 'SA' :
          {
            if ($this->isNextDigits($text, $index, 4))
            {
              $currentCode = 'SC';
              $out .= '99'; // To Code C
              $out .= substr($text, $index, 4);
              $index += 4;
            } else
            {
              $c = ord($text[$index++]);
              if ($c > ord('_'))
              {
                $currentCode = 'SB';
                $out .= 'TB';
                $out .= sprintf("%02d", $c - ord(' '));
              } else if ($c < ord(' '))
                $out .= sprintf("%02d", $c + 64);
              else
                $out .= sprintf("%02d", $c - ord(' '));
            }
          }
          break;
        case 'SB' :
          {
            if ($this->isNextDigits($text, $index, 4))
            {
              $currentCode = 'SC';
              $out .= '99'; // To Code C
              $out .= substr($text, $index, 4);
              $index += 4;
            } else
            {
              $c = ord($text[$index++]);
              if ($c < ord(' '))
              {
                $currentCode = 'SA';
                $out .= 'TA';
                $out .= sprintf("%02d", $c + 64);
              } else
              {
                $out .= sprintf("%02d", $c - ord(' '));
              }
            }
          }
          break;
        case 'SC' :
          {
            if ($this->isNextDigits($text, $index, 2))
            {
              $out .= substr($text, $index, 2);
              $index += 2;
            } else
            {
              $c = ord($text[$index++]);
              if ($c < ord(' '))
              {
                $currentCode = 'SA';
                $out .= 'TA';
                $out .= sprintf("%02d", $c + 64);
              } else
              {
                $currentCode = 'SB';
                $out .= 'TB';
                $out .= sprintf("%02d", $c - ord(' '));
              }
            }
          }
          break;
      }
    }
    return $out;
  }

  /**
   * Function     : Code128
   * Draw a Code1128 barcode on the given location
   * Input        : xpos, x position
   *                ypos, y position
   *                tcode, the barcode text to be genereted
   *                baseline, the baseline width
   *                height, the height of the barcode
   *                $bl_text, when true print the text.
   **/
  function Code128($xpos, $ypos, $tcode, $baseline=0.5, $height=5, $bl_text = 1)
  {
//                        BWBWBW
    $bar128c = array('00' => '212222',
    '01' => '222122',
    '02' => '222221',
    '03' => '121223',
    '04' => '121322',
    '05' => '131222',
    '06' => '122213',
    '07' => '122312',
    '08' => '132212',
    '09' => '221213',
    '10' => '221312',
    '11' => '231212',
    '12' => '112232',
    '13' => '122132',
    '14' => '122231',
    '15' => '113222',
    '16' => '123122',
    '17' => '123221',
    '18' => '223211',
    '19' => '221132',
    '20' => '221231',
    '21' => '213212',
    '22' => '223112',
    '23' => '312131',
    '24' => '311222',
    '25' => '321122',
    '26' => '321221',
    '27' => '312212',
    '28' => '322112',
    '29' => '322211',
    '30' => '212123',
    '31' => '212321',
    '32' => '232121',
    '33' => '111323',
    '34' => '131123',
    '35' => '131321',
    '36' => '112313',
    '37' => '132113',
    '38' => '132311',
    '39' => '211313',
    '40' => '231113',
    '41' => '231311',
    '42' => '112133',
    '43' => '112331',
    '44' => '132131',
    '45' => '113123',
    '46' => '113321',
    '47' => '133121',
    '48' => '313121',
    '49' => '211331',
    '50' => '231131',
    '51' => '213113',
    '52' => '213311',
    '53' => '213131',
    '54' => '311123',
    '55' => '311321',
    '56' => '331121',
    '57' => '312113',
    '58' => '312311',
    '59' => '332111',
    '60' => '314111',
    '61' => '221411',
    '62' => '431111',
    '63' => '111224',
    '64' => '111422',
    '65' => '121124',
    '66' => '121421',
    '67' => '141122',
    '68' => '141221',
    '69' => '112214',
    '70' => '112412',
    '71' => '122114',
    '72' => '122411',
    '73' => '142112',
    '74' => '142211',
    '75' => '241211',
    '76' => '221114',
    '77' => '413111',
    '78' => '241112',
    '79' => '134111',
    '80' => '111242',
    '81' => '121142',
    '82' => '121241',
    '83' => '114212',
    '84' => '124112',
    '85' => '124211',
    '86' => '411212',
    '87' => '421112',
    '88' => '421211',
    '89' => '212141',
    '90' => '214121',
    '91' => '412121',
    '92' => '111143',
    '93' => '111341',
    '94' => '131141',
    '95' => '114113',
    '96' => '114311',
    '97' => '411113',
    '98' => '411311',
    '99' => '113141',   // CODE_AB_TO_C
    'TB' => '114131',   // CODE_AC_TO_B
    'TA' => '311141',   // CODE_BC_TO_A
    'FN' => '411131',   // FNC1 / UCC/EAN-128.
    'SA' => '211412',   // START Code A
    'SB' => '211214',   // START Code B
    'SC' => '211232',   // START Code C
    'ST' => '2331112'); //STOP

    $this->SetFont('Arial','',10);

    $code = $this->getRawText128text($tcode, FALSE, $bar128c);

    if (!(strlen($code)%2))
    {
      if ($bl_text) $this->Text($xpos, $ypos + $height + 4, $tcode);
      $this->SetFillColor(0);

      $barcode = $code.$this->CheckChar128($code).'ST'; //include START and STOP-bars
      $pos = 0;
      //echo "'$barcode', code '$tcode'<BR>";

      //draw bars (including START and STOP)
      for ($digit = 0; $digit < strlen($barcode); $digit += 2)
      {
        $bars = $bar128c[substr($barcode, $digit, 2)];  //something like '113141' (BWBWBW)
        for ($bar = 0; $bar < strlen($bars); $bar++)
        {
          $int_lines = substr($bars, $bar, 1);
          if($bar % 2 == 0)
          {
            $this->Rect($xpos, $ypos, $baseline * $int_lines, $height, 'F');
          }
          $xpos += $baseline * $int_lines;
        }
      }
    } else
    {
      $this->SetFont('Arial','',8);
      $this->Text($xpos, $ypos + $height + 4, "Code128 is even '$code' len=".strlen($code));
    }
  }

  /** Calculates the checksum for interleave2/5.
   * @param text the numeric text
   * @return the checksum
   */
  function getChecksumInt2of5($text)
  {
    $mul = 3;
    $total = 0;
    for ($k = strlen($text) - 1; $k >= 0; --$k)
    {
      $n = $text[$k] - '0';
      $total += $mul * $n;
      $mul ^= 2;
    }
    return (10 - ($total % 10)) % 10;
  }

  /** Deletes all the non numeric characters from <CODE>text</CODE>.
   * @param text the text
   * @return a <CODE>String</CODE> with only numeric characters
   */
  function keepNumbers($text)
  {
    $sb = '';
    for ($k = 0; $k < strlen($text); ++$k)
    {
      $c = $text[$k];
      if ($c >= '0' && $c <= '9')
        $sb .= $c;
    }
    return $sb;
  }

  /**
   * Function     : CodeInter2of5
   * Draw a CodeInter2of5 barcode on the given location
   * Input        : xpos, x position
   *                ypos, y position
   *                code, the barcode text to be genereted
   *                baseline, the min baseline width
   *                height, the height of the barcode
   *                ratio, the ratio between wide and narrow lines
   *                bl_add_checksum, True when checksum should be used
   **/
  function CodeInter2of5($xpos,
  $ypos,
  $code,
  $baseline=0.5,
  $height=5,
  $ratio=2,
  $bl_add_checksum = TRUE)
  {
    $BARS = array (
    array( 0, 0, 1, 1, 0 ),
    array( 1, 0, 0, 0, 1 ),
    array( 0, 1, 0, 0, 1 ),
    array( 1, 1, 0, 0, 0 ),
    array( 0, 0, 1, 0, 1 ),
    array( 1, 0, 1, 0, 0 ),
    array( 0, 1, 1, 0, 0 ),
    array( 0, 0, 0, 1, 1 ),
    array( 1, 0, 0, 1, 0 ),
    array( 0, 1, 0, 1, 0 )
    );
    $wideline = $baseline * $ratio;

    $bCode = $this->keepNumbers($code);
    //echo "code = $code, bcode = $bCode, len= ".strlen($bCode);
    if ($bl_add_checksum) $bCode .= $this->getChecksumInt2of5($bCode);

    $len = strlen($bCode);
    //echo " check bcode = $bCode, len = $len";
    $fullWidth = $len * (3 * $baseline + 2 * $baseline * $wideline) + (6 + $wideline) * $baseline;
    $barStartX = $xpos;
    $barStartY = $ypos;
    $this->SetFont('Arial','B',14);
    $this->SetY($ypos + $height + 4);
    $this->SetX($xpos + 6*$wideline);
    $this->Cell($fullWidth, 4, $code, 0, 2, 'C');

    //$bars[] = getBarsInter25(bCode);
    //   text = keepNumbers(text);
    $bars = array(); //byte[text.length() * 5 + 7];
    $pb = 0;
    $bars[$pb++] = 0;
    $bars[$pb++] = 0;
    $bars[$pb++] = 0;
    $bars[$pb++] = 0;
    for ($k = 0; $k < $len/2; ++$k)
    {
      $c1 = $bCode[$k * 2];
      $c2 = $bCode[$k * 2 + 1];
      $b1 = $BARS[$c1];
      $b2 = $BARS[$c2];
      for ($j = 0; $j < 5; ++$j)
      {
        $bars[$pb++] = $b1[$j];
        $bars[$pb++] = $b2[$j];
      }
    }
    $bars[$pb++] = 1;
    $bars[$pb++] = 0;
    $bars[$pb++] = 0;

    $bl_print = TRUE;
    for ($k = 0; $k < count($bars); ++$k)
    {
      $w = ($bars[$k] == 0 ? $baseline : $baseline * $ratio);
      if ($bl_print)
      {
        $this->Rect($barStartX, $ypos, $w, $height, 'F');
      }
      $bl_print = !$bl_print;
      $barStartX += $w;
    }
  }

  /**
   * Function     : CodeEAN
   * Draw a EAN Code barcode on the given location
   * Input        : xpos, x position
   *                ypos, y position
   *                code, the barcode text to be genereted
   *                baseline, the min baseline width
   *                height, the height of the barcode
   *                font_size
   **/
  function CodeEAN($xpos,
  $ypos,
  $barcode,
  $baseline=0.5,
  $height=5,
  $int_font_size=10)
  {
    $side_bar = '101';
    $center_bar = '01010';

    // When barcode is 12 charchters long it is an UPC code add 0 before the string.
    $barcode = strlen($barcode) == 12 ? '0'.$barcode : $barcode;
    if (strlen($barcode) != 13)
    {
      echo ("Barcode ID length must be 13 numbers");
      return;
    }

    $encTable = array();
    $parityToEnc= array();

    $parityToEnc[0][2] = 0;
    $parityToEnc[0][3] = 0;
    $parityToEnc[0][4] = 0;
    $parityToEnc[0][5] = 0;
    $parityToEnc[0][6] = 0;
    $parityToEnc[0][7] = 0;
    $parityToEnc[1][2] = 0;
    $parityToEnc[1][3] = 0;
    $parityToEnc[1][4] = 1;
    $parityToEnc[1][5] = 0;
    $parityToEnc[1][6] = 1;
    $parityToEnc[1][7] = 1;
    $parityToEnc[2][2] = 0;
    $parityToEnc[2][3] = 0;
    $parityToEnc[2][4] = 1;
    $parityToEnc[2][5] = 1;
    $parityToEnc[2][6] = 0;
    $parityToEnc[2][7] = 1;
    $parityToEnc[3][2] = 0;
    $parityToEnc[3][3] = 0;
    $parityToEnc[3][4] = 1;
    $parityToEnc[3][5] = 1;
    $parityToEnc[3][6] = 1;
    $parityToEnc[3][7] = 0;
    $parityToEnc[4][2] = 0;
    $parityToEnc[4][3] = 1;
    $parityToEnc[4][4] = 0;
    $parityToEnc[4][5] = 0;
    $parityToEnc[4][6] = 1;
    $parityToEnc[4][7] = 1;
    $parityToEnc[5][2] = 0;
    $parityToEnc[5][3] = 1;
    $parityToEnc[5][4] = 1;
    $parityToEnc[5][5] = 0;
    $parityToEnc[5][6] = 0;
    $parityToEnc[5][7] = 1;
    $parityToEnc[6][2] = 0;
    $parityToEnc[6][3] = 1;
    $parityToEnc[6][4] = 1;
    $parityToEnc[6][5] = 1;
    $parityToEnc[6][6] = 0;
    $parityToEnc[6][7] = 0;
    $parityToEnc[7][2] = 0;
    $parityToEnc[7][3] = 1;
    $parityToEnc[7][4] = 0;
    $parityToEnc[7][5] = 1;
    $parityToEnc[7][6] = 0;
    $parityToEnc[7][7] = 1;
    $parityToEnc[8][2] = 0;
    $parityToEnc[8][3] = 1;
    $parityToEnc[8][4] = 0;
    $parityToEnc[8][5] = 1;
    $parityToEnc[8][6] = 1;
    $parityToEnc[8][7] = 0;
    $parityToEnc[9][2] = 0;
    $parityToEnc[9][3] = 1;
    $parityToEnc[9][4] = 1;
    $parityToEnc[9][5] = 0;
    $parityToEnc[9][6] = 1;
    $parityToEnc[9][7] = 0;

    $encTable[0][0] = "0001101";
    $encTable[0][1] = "0011001";
    $encTable[0][2] = "0010011";
    $encTable[0][3] = "0111101";
    $encTable[0][4] = "0100011";
    $encTable[0][5] = "0110001";
    $encTable[0][6] = "0101111";
    $encTable[0][7] = "0111011";
    $encTable[0][8] = "0110111";
    $encTable[0][9] = "0001011";
    $encTable[1][0] = "0100111";
    $encTable[1][1] = "0110011";
    $encTable[1][2] = "0011011";
    $encTable[1][3] = "0100001";
    $encTable[1][4] = "0011101";
    $encTable[1][5] = "0111001";
    $encTable[1][6] = "0000101";
    $encTable[1][7] = "0010001";
    $encTable[1][8] = "0001001";
    $encTable[1][9] = "0010111";
    $encTable[2][0] = "1110010";
    $encTable[2][1] = "1100110";
    $encTable[2][2] = "1101100";
    $encTable[2][3] = "1000010";
    $encTable[2][4] = "1011100";
    $encTable[2][5] = "1001110";
    $encTable[2][6] = "1010000";
    $encTable[2][7] = "1000100";
    $encTable[2][8] = "1001000";
    $encTable[2][9] = "1110100";

    $str_lastString = "";

    $str_lastString .= $side_bar;

    for ($i = 1; $i < 7; ++$i)
    {
      $firstDigit_i = $barcode[0];
      $curDigit_i = $barcode[$i];
      $str_lastString .= $encTable[$parityToEnc[$firstDigit_i][$i+1]][$curDigit_i];
    }

    $str_lastString .= $center_bar;

    for ($i = 7; $i < 13; ++$i)
    {
      $curDigit_i = $barcode[$i];
      $str_lastString .= $encTable[2][$curDigit_i];
    }

    $str_lastString .= $side_bar;
    //echo $str_lastString."<br>";

    $barStartX = $xpos+$baseline*6;
    $str_lengt_last = strlen($str_lastString);
    for ($k = 0; $k < $str_lengt_last; ++$k)
    {
      if ($str_lastString[$k] == 1)
      {
        $used_height = ($k <3 || ($k > ($str_lengt_last/2-2) && $k < ($str_lengt_last/2+1)) || $k > ($str_lengt_last -4)) ? $height * 1.2 : $height;
        $this->Rect($barStartX, $ypos, $baseline, $used_height, 'F');
      }
      $barStartX += $baseline;
    }

    $this->SetFont('Arial','',$int_font_size);
    $this->Text($xpos, $ypos + $height*1.2, $barcode[0]);
    $this->Text($xpos+$baseline*13, $ypos + $height*1.2, $barcode[1].$barcode[2].$barcode[3].$barcode[4].$barcode[5].$barcode[6]);
    $this->Text($xpos+$baseline*58, $ypos + $height*1.2, $barcode[7].$barcode[8].$barcode[9].$barcode[10].$barcode[11].$barcode[12]);

  }

  function Circle($x,$y,$r,$style='')
  {
    $this->Ellipse($x,$y,$r,$r,$style);
  }

  function Ellipse($x,$y,$rx,$ry,$style='D')
  {
    if($style=='F')
      $op='f';
    elseif($style=='FD' or $style=='DF')
      $op='B';
    else
      $op='S';
    $lx=4/3*(M_SQRT2-1)*$rx;
    $ly=4/3*(M_SQRT2-1)*$ry;
    $k=$this->k;
    $h=$this->h;
    $this->_out(sprintf('%.2f %.2f m %.2f %.2f %.2f %.2f %.2f %.2f c',
    ($x+$rx)*$k,($h-$y)*$k,
    ($x+$rx)*$k,($h-($y-$ly))*$k,
    ($x+$lx)*$k,($h-($y-$ry))*$k,
    $x*$k,($h-($y-$ry))*$k));
    $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c',
    ($x-$lx)*$k,($h-($y-$ry))*$k,
    ($x-$rx)*$k,($h-($y-$ly))*$k,
    ($x-$rx)*$k,($h-$y)*$k));
    $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c',
    ($x-$rx)*$k,($h-($y+$ly))*$k,
    ($x-$lx)*$k,($h-($y+$ry))*$k,
    $x*$k,($h-($y+$ry))*$k));
    $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c %s',
    ($x+$lx)*$k,($h-($y+$ry))*$k,
    ($x+$rx)*$k,($h-($y+$ly))*$k,
    ($x+$rx)*$k,($h-$y)*$k,
    $op));
  }

  // Iwex Logo
  function PrintIwexLogo($int_with=35, $bl_bw=FALSE)
  {
    $int_x = $this->GetX();
    $int_y = $this->GetY();
    $flt_hight = $int_with * 5/8;
    /*
        $this->SetDrawColor(0);
        $this->SetLineWidth(0.1);
        $this->Rect($int_x, $int_y, $int_with, $flt_hight);
        $this->Line($int_x+$int_with/2, $int_y, $int_x+$int_with/2, $int_y + $flt_hight);
    */
    if ($bl_bw)
    {
      $this->SetTextColor(0);
      $this->SetDrawColor(50);
    } else
    {
      $this->SetTextColor(0,0,255);
      $this->SetDrawColor(255,0,0);
    }

    if (!$this->bl_tahoma_incl)
    {
      $this->AddFont('tahomabd','B','tahomabd.php');
      $this->bl_tahoma_incl = TRUE;
    }
    $this->SetFont('tahomabd','B', $int_with*.75);

    $this->SetLineWidth($int_with*0.0075);

    $int_corr = 0;
    if ($int_with > 35)
    {
      $int_corr = (0.72 - 0.69) * ($int_with - 35);
    }
    $flt_x_center = $int_x + $int_with*0.72 - $int_corr;
    $flt_y_center = $int_y + $flt_hight*0.5;
    $flt_radius = $flt_hight*0.9/2;
    $this->Circle($flt_x_center, $flt_y_center, $flt_radius);

    $flt_x_start = $flt_x_center - $flt_radius;
    $flt_y_start = $flt_y_center - $flt_radius;
    $flt_x_end = $flt_x_center + $flt_radius;
    $flt_y_end = $flt_y_center + $flt_radius;
    $this->Line($flt_x_start, $flt_y_start, $flt_x_end, $flt_y_end);
    $this->Line($flt_x_start, $flt_y_end, $flt_x_end, $flt_y_start);

    $this->SetLineWidth($int_with*0.05);
    $flt_x_start = $flt_x_center - $flt_radius/3;
    $flt_y_start = $flt_y_center - $flt_radius/3;
    $flt_x_end = $flt_x_center + $flt_radius/3;
    $flt_y_end = $flt_y_center + $flt_radius/3;
    $this->Line($flt_x_start, $flt_y_start, $flt_x_end, $flt_y_end);
    $this->Line($flt_x_start, $flt_y_end, $flt_x_end, $flt_y_start);

    $this->SetY($int_y + 0.35*$flt_hight);
    $this->SetX($int_x);
    $this->Cell($int_with*0.4, $flt_hight*0.35, "IWE");
  }
}

/*********************************************************
 * Class defintion IwexPDF
 * Will create the default Iwex PDF class
 *********************************************************/
class IwexPDF extends PDF_MC_Table
{
  var $ary_header = array();
  var $str_head_discription = "";
  var $bl_bw = TRUE;
  var $bl_use_head = TRUE;
  var $bl_use_foot = TRUE;
  var $bl_print_bankinfo = TRUE;
  var $fill=0;

  function usehead($bl_use)
  {
    $this->bl_use_head = $bl_use;
  }

  function usefoot($bl_use)
  {
    $this->bl_use_foot = $bl_use;
  }

  function usebankinfo($bl_bank)
  {
    $this->bl_print_bankinfo = $bl_bank;
    echo $this->bl_print_bankinfo ;
  }

  //Page header
  function Header()
  {
    if ($this->bl_use_head)
    {
      //Logo
      if ($this->bl_bw)
      {
        $this->Image($_SERVER['DOCUMENT_ROOT'].'/images/' . LOGOCOLOR ,10,8,35);
      } else
      {
        $this->Image($_SERVER['DOCUMENT_ROOT'].'/images/' . LOGOBLACK ,10,8,35);
      }
      //Arial vet 15
      $this->SetFont('Arial','B',15);
      //Beweeg naar rechts
      $this->Cell(50);
      //Titel
      $this->Cell(90,10,'Prijslijst' . COMPANYNAME,0,0,'C');
      //Line break
      $this->Ln(20);
      //Author
    }
    $this->SetAuthor(COMPANYNAME);
  }

  function PrintBankInfo()
  {
    //Arial cursief 8
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(0);
    // check which ones are filled
    $this->Cell(50,10,"REGISTRO MERCANTIL: ". KVK,0,0,'L');
    $this->Cell(37,10,"BTW/VAT: ".IWEX_VAT_NUMBER, 0, 0, 'L');
    $this->Ln(4);
    if(strlen(GIRO) <> 0)
    {
      $this->Cell(48,10,"GIRO: ".GIRO,0,0,'L');
      $this->Cell(50,10,"IBAN: " . IBANGIRO,0,0,'L');
      $this->Cell(33,10,"SWIFT/BIC: ".SWIFTGIRO,0,0,'L');
      $this->Ln(4);
    }
    if(strlen(BANK) <> 0)
    {
      $this->Cell(48,10,"BANK: ".BANK,0,0,'L');
      $this->Cell(50,10,"IBAN: " . IBANBANK,0,0,'L');
      $this->Cell(33,10,"SWIFT/BIC: ".SWIFTBANK,0,0,'L');
      $this->Ln(1);
    }
    //$this->Cell(30,10,"BANK: ".BANK,0,0,'L');
  }

  //Page footer
  function Footer()
  {
    Global $ary_lang;
    if ($this->bl_use_foot)
    {
      //Positie 1.5 cm van de onderkant
      $this->SetY(-40);

      //Positie 19 cm van de rechterkant
      $this->SetX(-195);

      if ($this->bl_print_bankinfo)
      {
        $this->PrintBankInfo();

        //Line break
        $this->Ln(4);
        //Arial cursief 8
      }

      $this->SetFont('Arial','I',8);
      //Line break
      $this->Ln(1);
      //Pagina nummer
      $this->Cell(0,10, $ary_lang["pdf_pagenum"]. " " .$this->PageNo().'/{nb}',0,0,'C');
    }
  }

  function PDFheaderPrint()
  {
    //Kleuren, lijn dikte en vet lettertype
    if ($this->bl_bw)
    {
      $this->SetFillColor(BW_COLOR);
      $this->SetDrawColor(BW_COLOR);
    } else
    {
      $this->SetFillColor(200,74,19);
      $this->SetDrawColor(244,113,20); //(0,0,255);
    }
    $this->SetTextColor(255);
    $this->SetFont('Arial','B',8);
    $this->fill = 0;

    if ($this->str_head_discription != "")
    {
      //If the height h would cause an overflow, add a new page immediately
      if($this->GetY()+$this->rowhight*2>$this->PageBreakTrigger)
      {
        $this->AddPage($this->CurOrientation);
      }

      $flt_total_width = 0;
      for($i=0; $i<count($this->widths); $i++)
      {
        $flt_total_width += $this->widths[$i];
      }
      $this->Cell($flt_total_width,
      $this->rowhight,
      substr($this->str_head_discription,
      0,
      130),
      0,
      1,
      'C',
      1);
      //Herstel van kleuren en lettertype
      $this->SetFillColor(255);
      if ($this->bl_bw)
      {
        $this->SetTextColor(BW_COLOR);
      } else
      {
        $this->SetTextColor(64,43,47);
      }
    } else if($this->GetY()+$this->rowhight>$this->PageBreakTrigger)
    {
      $this->AddPage($this->CurOrientation);
    }

    //Koptekst
    for($i=0;$i<count($this->ary_header);$i++)
      $this->Cell($this->widths[$i],$this->rowhight,$this->ary_header[$i],'B',0,'C',1);

    $this->Ln($this->rowhight+1);

    //Herstel van kleuren en lettertype
    $this->SetFillColor(255);
    $this->SetTextColor(0);
    $this->SetFont('Arial','',8);
  }

  /*********************************************************
     * Function PDFtable
     * Will create a nice table in a Iwex PDF file.
     *********************************************************/
  function PDFtable($header, $data, $str_discription = "")
  {
    $this->ary_header = $header;
    $this->str_head_discription = $str_discription;
    $border_temp = $this->borders;
    $border_nofill = array();
    foreach ($border_temp as $key => $item)
    {
      $border_nofill[$key] = strpos("D", $border_temp[$key]) !== FALSE ? "D" : "";
    }

    $this->PDFheaderPrint();
    //Gegevens
    foreach($data as $row)
    {
      if ($this->fill)
      {
        $this->borders = $border_temp;

        if ($this->bl_bw)
        {
          $this->SetFillColor(233);
        }
        else
        {
          $this->SetFillColor(253,227,183);
          //$this->SetFillColor(249,167,114);
        }
      } else
      {
        $this->borders = $border_nofill;

        //$this->SetFillColor(255);
      }
      $this->Row($row);

      $this->fill= !$this->fill;
    }
    $this->Cell(array_sum($this->widths),0,'','T');
    $this->ary_header = array();
  }

  //Eenvoudige tabel
  function BasicTable($header,$data)
  {
    //Koptekst
    foreach($header as $col)
      $this->Cell(20,7,$col,1);
    $this->Ln();
    //Gegevens
    foreach($data as $row)
    {
      foreach($row as $col)
        $this->Cell(20,6,$col,1);
      $this->Ln();
    }
  }

  function CheckPageBreak($h)
  {
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
    {
      $this->AddPage($this->CurOrientation);
      $this->PDFheaderPrint();
    }
  }

  function SetColor($bl_color)
  {
    $this->bl_bw = !$bl_color;
  }

  function Output($name='',$dest='')
  {
    $dest=strtoupper($dest);

    // Define the header after the include. IE need this! Because there is a bug in it.
    if ($dest == 'I' || $dest == '')
    {
      if(!headers_sent())
      {
        header("Cache-Control: private");
      }
    }
    parent::Output($name, $dest);
  }
} // End of PDF class

/*********************************************************
 * Class defintion IwexTemplatePDF
 * Will create the default Iwex Template PDF class
 *********************************************************/
class IwexTemplatePDF extends IwexPDF
{
  var $bl_purchase_order = FALSE;
  var $bl_invoice = FALSE;
  var $bl_copy_invoice = FALSE;
  var $bl_proforma_invoice = FALSE;
  var $bl_order_comfirm = FALSE;
  var $bl_offerte = FALSE;


  var $str_delivery_cond = "";
  var $str_foottxt = '';

  function SetFootTxt($str_txt)
  {
    $this->str_foottxt=$str_txt;
  }

  function SetDeliveryCond($str_txt)
  {
    $this->str_delivery_cond = $str_txt;
  }

  //Page header
  function Header()
  {
    global $ary_lang;
    $this->SetMargins(15,20,15);

    $int_img_wd = 30;
    $int_iwex_adr_wd = 40;
    $int_invoice_wd = 50;
    $int_lever_wd = 80;
    $int_cell_h = 9;

    $int_x = $this->GetX();
    $int_y = $this->GetY();

    //Arial vet 15
    $this->SetFont('Arial','B',20);
    $this->SetTextColor(0);
    //Titel
    if ($this->bl_purchase_order)
    {
      $this->Cell($int_invoice_wd+5,10, $ary_lang["pdf_purchase_title"],0,0,'L');
      $this->SetFont('Arial','',8);
      $this->Cell($int_invoice_wd,10,$ary_lang["pdf_purchase_title_small"],0,0,'L');
    } else if ($this->bl_copy_invoice)
    {
      $this->Cell($int_invoice_wd,10, $ary_lang["pdf_invoicecopy_title"] ,0,0,'L');
      $this->SetFont('Arial','',8);
      $this->Cell($int_invoice_wd - 5,10, $ary_lang["pdf_invoicecopy_title_small"],0,0,'L');
    } else if ($this->bl_proforma_invoice)
    {
      $this->Cell($int_invoice_wd,10, $ary_lang["pdf_proforma_title"],0,0,'L');
      $this->SetFont('Arial','',8);
      $this->Cell($int_invoice_wd - 5,10, $ary_lang["pdf_proforma_title_small"],0,0,'L');
    } else if ($this->bl_order_comfirm)
    {
      $this->Cell($int_invoice_wd,10, $ary_lang["pdf_order_title"],0,0,'L');
      $this->SetFont('Arial','',8);
      $this->Cell($int_invoice_wd - 5,10,'',0,0,'L');
    } else if ($this->bl_offerte)
    {
      $this->Cell($int_invoice_wd,10, $ary_lang["pdf_offerte_title"],0,0,'L');
      $this->SetFont('Arial','',8);
      $this->Cell($int_invoice_wd - 5,10,'',0,0,'L');
    } else
    {
      $this->Cell($int_invoice_wd,10, $ary_lang["pdf_invoice_title"],0,0,'L');
      $this->SetFont('Arial','',8);
      $this->Cell($int_invoice_wd - 5,10,$ary_lang["pdf_invoice_title_small"],0,0,'L');
    }

    // Set to the next line
    $this->SetY($int_y + 10);
    $this->SetX($int_x);

    $this->MultiCell($int_lever_wd,
    4,
    $this->str_delivery_cond,
    0,
    'L');

    // Set to the next line
    $this->SetY($int_y + 20);
    $this->SetX($int_x);

    if ($this->bl_purchase_order)
    {
      $this->Cell($int_invoice_wd,
      10,
      $ary_lang["pdf_email"].' ' .$GLOBALS["ary_config"]["email.purchase"] . " ". IWEX_WEBSITE,
      0,
      0,
      'L');
    } else
    {
      $this->Cell($int_invoice_wd,
      10,
      $ary_lang["pdf_email"].' ' . $GLOBALS["ary_config"]["email.admin"] . " " . IWEX_WEBSITE,
      0,
      0,
      'L');
    }

    // Make a 50% black/grey line.
    $this->SetDrawColor(BW_COLOR);
    $this->SetLineWidth(0.1);
    $this->Line($int_x, $int_y+30, $int_x+179, $int_y+30);

    // Set to the next position
    $this->SetY($int_y);
    $this->SetX($int_x+80);
    $this->MultiCell(10,
    5,
    $ary_lang["pdf_from"]);

    // Set to the next position
    $this->SetY($int_y);
    $this->SetX($int_x+90);
    $this->SetFont('Arial','B',11);
    $this->MultiCell(70,
    5,
    IWEX_ADRES_INFO,
    0,
    'L');

    // Set to the next position
    $this->SetY($int_y+25);
    $this->SetX($int_x+90);
    $this->Cell(80,
    6,
    IWEX_PHONE_INFO);

    //Logo
    if ($this->bl_bw)
    {
      $this->Image($_SERVER['DOCUMENT_ROOT']."/images/" . LOGOBIGBLACK ,$int_x+150,$int_y,29);
    }
    else
    {
      $this->Image($_SERVER['DOCUMENT_ROOT']."/images/" . LOGOBIGCOLOR ,$int_x+150,$int_y,29);
    }

    //Author
    $this->SetAuthor('Pumiwex');
    if ($this->bl_purchase_order)
    {
      $this->SetTitle('Purchase order / Inkoop order');
    } else
    {
      $this->SetTitle('Factuur/Invoice');
    }
    $this->Ln(6);
  }

  //Page footer
  function Footer()
  {
    global $ary_lang;

    if ($this->bl_use_foot)
    {
      //Positie 1.5 cm van de onderkant
      $this->SetY(-20);

      //Positie 19 cm van de rechterkant
      $this->SetX(-195);

      if ($this->bl_print_bankinfo)
      {
        $this->PrintBankInfo();

        //Line break
        $this->Ln(5);
        //Arial cursief 8
      }

      $this->SetFont('Arial','I',8);
      //Pagina nummer
      $this->Cell(0,10, $ary_lang["pdf_pagenum"].' '.$this->PageNo()."/{nb} $this->str_foottxt",0,0,'C');
    }
  }
} // End of PDF class

/*********************************************************
 * Class defintion InvoicePDF
 * Will create the default Iwex invoice PDF class
 *********************************************************/
class InvoicePDF extends IwexTemplatePDF
{
  function InvoicePDF($orientation='P',$unit='mm',$format='A4')
  {
    global $ary_lang;

    //$this->IwexTemplatePDF($orientation, $unit ,$format);
    $this->FPDF_Protection($orientation, $unit ,$format);
    $this->bl_invoice = TRUE;
    $this->str_delivery_cond = $ary_lang["pdf_header_description"];
  }

  function SetCopyInvoice($bl_copy)
  {
    $this->bl_copy_invoice=$bl_copy;
  }

  function SetProformaInvoice($bl_proforma)
  {
    $this->bl_proforma_invoice=$bl_proforma;
  }

  function SetOrderComfirm($bl_order_comfirm)
  {
    $this->bl_order_comfirm=$bl_order_comfirm;
  }

  function SetOfferte($bl_offerte)
  {
    $this->bl_offerte=$bl_offerte;
  }
}

/*********************************************************
 * Class defintion PurchaseOrderPDF
 * Will create the default Iwex Purchase Order PDF class
 *********************************************************/
class PurchaseOrderPDF extends IwexTemplatePDF
{
  function PurchaseOrderPDF($orientation='P',$unit='mm',$format='A4')
  {
    parent::IwexTemplatePDF($orientation, $unit ,$format);
    $this->bl_purchase_order = TRUE;
  }
}

/*********************************************************
 * Class defintion PakagelistPDF
 * Will create the default Iwex Invoice PDF class
 *********************************************************/
class PakagelistPDF extends IwexPDF
{
  var $int_box_id, $int_last_box_id, $int_customer_id, $int_shipment_id, $bl_show_header = TRUE;

  function SetBox($int_box, $int_last_box, $int_customer, $int_shipment, $bl_header = TRUE)
  {
    $this->int_box_id =$int_box;
    $this->int_last_box_id =$int_last_box;
    $this->int_customer_id =$int_customer;
    $this->int_shipment_id =$int_shipment;
    $this->bl_show_header = $bl_header;
  }

  function showlabelname()
  {
    Global $ary_lang;
    //Titel
    if ($this->int_box_id == DELIVERY_NOTE_ID)
    {
      $this->Cell(25,10, $ary_lang["pdf_delivery_title"] ,0,0,'L');
    } else
    {
      $this->Cell(25,10, $ary_lang["pdf_packingslip"] ." $this->int_box_id / $this->int_last_box_id",0,0,'L');
    }
  }

  //Page header
  function Header()
  {
    Global $ary_lang;

    $int_img_wd = 30;
    $int_iwex_adr_wd = 40;
    $int_lever_wd = 70;
    $int_cell_h = 9;

    $this->SetMargins(15,15,15);
    $this->SetTextColor(0);

    $int_x = $this->GetX();
    $int_y = $this->GetY();

    if ($this->bl_show_header)
    {
      $this->SetFont('Arial','',8);
      $this->MultiCell(10,
      4,
      $ary_lang["pdf_from"]);

      // Set to the next position
      $this->SetY($int_y);
      $this->SetX($int_x+10);
      $this->MultiCell(70,
      4,
      IWEX_ADRES_INFO,
      0,
      'L');

      // Set to the next position
      $this->SetY($int_y+15);
      $this->SetX($int_x);
      $this->MultiCell(70,
      4,
      IWEX_PHONE_INFO . "\n" . $ary_lang["pdf_email"] . " " . $GLOBALS["ary_config"]["email.logistical"]);

      // Set to the next position
      $this->SetY($int_y);
      $this->SetX($int_x+70);

      //Arial vet 15
      $this->SetFont('Arial','B',20);

      $this->showlabelname();

      // Set to the next position
      $this->SetY($int_y+10);
      $this->SetX($int_x+70);

      $this->SetFont('code39','',20);
      $this->Cell(50,10,"*$this->int_shipment_id*",0,0);


      // Make a 50% black/grey line.
      $this->SetDrawColor(BW_COLOR);
      $this->Line($int_x, $int_y+25, $int_x+179, $int_y+25);

      //Logo
      if ($this->bl_bw)
      {
        $this->Image($_SERVER['DOCUMENT_ROOT'].'/images/'. LOGOBIGBLACK,$int_x+150,$int_y,30);
      }
      else
      {
        $this->Image($_SERVER['DOCUMENT_ROOT'].'/images/'. LOGOBIGCOLOR,$int_x+150,$int_y,30);
      }
    } else
    {
      $this->Ln(15);

      //Arial vet 15
      $this->SetFont('Arial','B',12);
      $this->showlabelname();
    }

    //Author
    $this->SetAuthor($ary_lang["pdf_author"]);
    $this->SetTitle($ary_lang["pdf_boxpackingtitle"]);
    $this->Ln(20);
  }

  //Page footer
  function Footer()
  {
    Global $ary_lang;
    //Positie 2 cm van de onderkant
    $this->SetY(-20);

    $int_x = $this->GetX();
    $int_y = $this->GetY();

    // Make a 50% black/grey line.
    /*$this->SetLineWidth(0.2);
        $this->SetDrawColor(125);
        $this->Line($int_x, $int_y, $int_x+179, $int_y);*/

    //Line break
    $this->Ln(5);

    //Arial cursief 8
    $this->SetFont('Arial','I',8);
    //Pagina nummer
    $this->Cell(0,10, $ary_lang["pdf_pagenum"] . " ".$this->PageNo()."/{nb}",0,0,'C');
  }

} // End of PDF class

/*
 * Class defintion IwexTemplateLetterPDF
 * Will create the default Iwex Letter Template PDF class
*/
class IwexTemplateLetterPDF extends IwexTemplatePDF
{
  //Page header
  function Header()
  {
    $this->SetMargins(15,20,15);
    $this->SetTextColor(0);

    $int_x = $this->GetX();
    $int_y = $this->GetY();

    // Set to the next position
    $this->SetY($int_y + 2);
    $this->SetX($int_x+105);
    $this->SetFont('Arial','',8);
    $this->MultiCell(70,
    4,
    IWEX_ADRES_INFO);

    // Set to the next position
    $this->SetY($int_y + 2);
    $this->SetX($int_x+145);
    $this->MultiCell(70,
    4,
    IWEX_PHONE_INFO_SEPERATED,
    0,
    'L');

    // Set to the next position
    $this->SetY($int_y);
    $this->SetX($int_x+70);

    //Arial vet 15
    //$this->SetFont('Arial','B',20);

    //Logo
    if ($this->bl_bw)
    {
      $this->Image($_SERVER['DOCUMENT_ROOT']."/images/" . LOGOBIGBLACK,17,14,35);
    }
    else
    {
      $this->Image($_SERVER['DOCUMENT_ROOT']."/images/" . LOGOBIGCOLOR,17,14,15);
    }
    $this->Ln(20);
  }
} // End of PDF class




?>
