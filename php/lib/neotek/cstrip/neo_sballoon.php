<?php

include('lib\neotek\cstrip\neo_intltxt.php');

function distance($x1,$y1,$x2,$y2)
        {
		$dist=($x2-$x1)*($x2-$x1)+($y2-$y1)*($y2-$y1);
                return $dist;
        }
	


class neo_sballoon
{
	var $id;
	var $order;
	var $frame_id;
	var $type;
	var $text_no;
	var $srcX;
	var $srcY;
	var $posX;
	var $posY;
	var $fieldsArr;
	function neo_sballoon()
	{
	       $this->id = 0;
	       $this->order = 1;
	       $this->frame_id = 0;
	       $this->type = 'dialogue';
	       $this->text_no = 1;
	       $this->srcX = 0;
	       $this->srcY = 0;
	       $this->posX = 0;
	       $this->posY = 0;
	       $this->fieldsArr = array(&$this->id, &$this->order, &$this->frame_id, &$this->type, &$this->text_no, &$this->srcX, &$this->srcY, &$this->posX, &$this->posY);

	}
	function get_neo_sballoon($id)
	{
		$this->id = $id;
		$sballoon = new record("neo_sballoon");
		$sballoon->get_info($this->id);
		$sballoon->updateValues($this->fieldsArr, $sballoon->recordData);
	}
	function update_sballoon($values)
	{
		$sballoon = new record("neo_sballoon");
		$sballoon->update($this->id, $values);
		$sballoon->updateValues($this->fieldsArr, $sballoon->recordData);
	}
	function insert_sballoon($values)
	{
		$sballoon = new record("neo_sballoon");
		$sballoon->insert($values);
		$sballoon->updateValues($this->fieldsArr, $sballoon->recordData);
	}
	function delete_sballoon()
	{
		$sballoon = new record("neo_sballoon");
		$sballoon->delete($this->id);
	}
	function format_sballoon($textNo)
	{
		$txt = new record("neo_intltxt");
		$txt->get_info($textNo);
		$text = $txt->recordData["Txt"];
		
		$fontID = 7;
		$border = 8;
			
		$widthFont = imagefontwidth($fontID);
		$heightRow = imagefontheight($fontID);
		$heightRow = $heightRow;// + $heightRow/3;  
			
		$dimText = $widthFont*strlen($text);
		$noC = strlen($text);
		$noW = str_word_count($text);
		$words = str_word_count($text,2);
			
		$noRows = floor(sqrt($noW*4 + 9) -3);
		$noWrow = $noRows + 1;
           	$l = 2*$border + $noRows*$heightRow;
			
           	$k = 0;
           	$i = 0;
           	while($k < $noWrow)
         	{
           		if($words[$i] != NULL)
          		{
          			$k = $k+1;
            			$poz = $i;
				$len = strlen($words[$i]);
            		}
			
           		$i = $i+1;
		
			
           	}
		
            	$poz= $i + $len + 2;
		$L = 2*$border + $poz*$widthFont;
		$format=array("W"=>$L,"H"=>$l , "poz"=>$poz , "noRows"=>$noRows);
		return $format;
	}
	function display_balloon($id, &$im)
	{ 
		$balloon = new record("neo_sballoon");
		$balloon->get_info($id);
		
		$txt = new record("neo_intltxt");
		$txt->get_info($balloon->recordData["IntlTxtNo"]);
		$text = $txt->recordData["Txt"];

		$format = $this->format_sballoon($balloon->recordData["IntlTxtNo"]);
		$L=$format["W"];
		$l=$format["H"];
		$poz=$format["poz"];
		
		$fontID = 7;
		$border = 7;
		
		$heightRow = imagefontheight($fontID);
		$heightRow = $heightRow;  
		$widthFont = imagefontwidth($fontID);
		
		$sourceX=$balloon->recordData["SrcX"];
		$sourceY=$balloon->recordData["SrcY"];
		$centerX=$balloon->recordData["PosX"];
		$centerY=$balloon->recordData["PosY"];
		
		$black = imagecolorallocate(&$im,255,255,255);
		$whiteT = imagecolorallocatealpha(&$im,0,0,0,90);
		$whiteTr = imagecolorallocatealpha(&$im,0,0,0,100);
		
	
		//middle coordinates
                $mij1x=$centerX-$L/2;
                $mij1y=$centerY;

                $mij2x=$centerX;
                $mij2y=$centerY-$l/2;

                $mij3x=$centerX+$L/2;
                $mij3y=$centerY;

                $mij4x=$centerX;
                $mij4y=$centerY+$l/2;

                //the closest middle to the source point
                $d1=distance($mij1x,$mij1y,$sourceX,$sourceY);
                $d2=distance($mij2x,$mij2y,$sourceX,$sourceY);
                $d3=distance($mij3x,$mij3y,$sourceX,$sourceY);
		$d4=distance($mij4x,$mij4y,$sourceX,$sourceY);

                $min=$d1;
                $mijX=$mij1x;
                $mijY=$mij1y;
              
	        if($min>$d2)
		{
			$min=$d2;
                        $mijX=$mij2x;
                        $mijY=$mij2y;
                }
                if($min>$d3)
		{
			$min=$d3;
                        $mijX=$mij3x;
                        $mijY=$mij3y;
                }
                if($min>$d4)
		{
                        $min=$d4;
			$mijX=$mij4x;
                        $mijY=$mij4y;
                }    

                //balloon's intersection with the lines from the source point
		
		if($mijX==$centerX)
		{
			$dot1X=$mijX-10;
                        $dot2X=$mijX+10;
                        $dot1Y=$mijY;
                        $dot2Y=$mijY;
                }
                if($mijY==$centerY)
		{
			$dot1Y=$mijY-10;
                        $dot2Y=$mijY+10;
                        $dot1X=$mijX;
                        $dot2X=$mijX;
                }
    
		// the coordinates of the points that create the balloon
                $lucornerx=$centerX-$L/2+10;
                $lucornery=$centerY-$l/2;

                $rucornerx=$centerX+$L/2-10;
                $rucornery=$centerY-$l/2;

                $rucornerx1=$centerX+$L/2;
                $rucornery1=$centerY-$l/2+10;

                $rdcornerx1=$centerX+$L/2;
                $rdcornery1=$centerY+$l/2-10;

                $rdcornerx=$centerX+$L/2-10;
		$rdcornery=$centerY+$l/2; 

		$ldcornerx=$centerX-$L/2+10;
		$ldcornery=$centerY+$l/2;

		$ldcornerx1=$centerX-$L/2;
                $ldcornery1=$centerY+$l/2-10;

                $lucornerx1=$centerX-$L/2;
                $lucornery1=$centerY-$l/2+10;

               
		//line generating functions
		$line1=imageline(&$im,$sourceX,$sourceY,$dot1X,$dot1Y,$whiteT);
                $line2=imageline(&$im,$sourceX,$sourceY,$dot2X,$dot2Y,$whiteT);

                if($mijX==$centerX)
			if($mijY<$centerY)
			{
				$line3=imageline(&$im,$lucornerx,$lucornery,$dot1X,$dot1Y,$whiteT);
                                $line4=imageline(&$im,$dot2X,$dot2Y,$rucornerx,$rucornery,$whiteT);
                                $line5=imageline(&$im,$rucornerx1,$rucornery1,$rdcornerx1,$rdcornery1,$whiteT);
                                $line6=imageline(&$im,$rdcornerx,$rdcornery,$ldcornerx,$ldcornery,$whiteT);
                                $line7=imageline(&$im,$lucornerx1,$lucornery1,$ldcornerx1,$ldcornery1,$whiteT);
                        }
			else
			{
				$line3=imageline(&$im,$ldcornerx,$ldcornery,$dot1X,$dot1Y,$whiteT);
                                $line4=imageline(&$im,$dot2X,$dot2Y,$rdcornerx,$rdcornery,$whiteT);
                                $line5=imageline(&$im,$lucornerx1,$lucornery1,$ldcornerx1,$ldcornery1,$whiteT); 
                                $line6=imageline(&$im,$rucornerx,$rucornery,$lucornerx,$lucornery,$whiteT); 
                                $line7=imageline(&$im,$rucornerx1,$rucornery1,$rdcornerx1,$rdcornery1,$whiteT);
                        }
                else
			if($mijY==$centerY)
				if($mijX<$centerX)
				{
					$line3=imageline(&$im,$lucornerx1,$lucornery1,$dot1X,$dot1Y,$whiteT);
                                        $line4=imageline(&$im,$dot2X,$dot2Y,$ldcornerx1,$ldcornery1,$whiteT);
					$line5=imageline(&$im,$lucornerx,$lucornery,$rucornerx,$rucornery,$whiteT);
                                        $line6=imageline(&$im,$rucornerx1,$rucornery1,$rdcornerx1,$rdcornery1,$whiteT);
					$line7=imageline(&$im,$rdcornerx,$rdcornery,$ldcornerx,$ldcornery,$whiteT);
				}
				else
				{
					$line3=imageline(&$im,$rucornerx1,$rucornery1,$dot1X,$dot1Y,$whiteT);
                                        $line4=imageline(&$im,$dot2X,$dot2Y,$rdcornerx1,$rdcornery1,$whiteT);
                                        $line5=imageline(&$im,$rdcornerx,$rdcornery,$ldcornerx,$ldcornery,$whiteT);
	                                $line6=imageline(&$im,$lucornerx1,$lucornery1,$ldcornerx1,$ldcornery1,$whiteT);
	                                $line7=imageline(&$im,$lucornerx,$lucornery,$rucornerx,$rucornery,$whiteT);
                                }
            
      
		//center of the arc coordinates
		$cx1=$lucornerx;
                $cy1=$lucornery1;

		$cx2=$rucornerx;
                $cy2=$rucornery1;

                $cx3=$rdcornerx;
		$cy3=$rdcornery1;

                $cx4=$ldcornerx;
                $cy4=$ldcornery1;

                //arc generating functions
		$arc1=imagearc(&$im,$cx1,$cy1,21,21,180,270,$whiteTr);
                $arc2=imagearc(&$im,$cx2,$cy2,21,21,270,0,$whiteTr);
		$arc3=imagearc(&$im,$cx3,$cy3,21,21,0,90,$whiteTr);
                $arc4=imagearc(&$im,$cx4,$cy4,21,21,90,180,$whiteTr);
		
		//filled-balloon
		$dots1 = array($sourceX, $sourceY, $dot1X, $dot1Y, $dot2X, $dot2Y);
		imagefilledpolygon(&$im,$dots1,3,$whiteT);
		
		$dots2 = array($rucornerx1, $rucornery1, $rucornerx, $rucornery, $lucornerx, $lucornery, $lucornerx1, $lucornery1, $ldcornerx1, $ldcornery1, $ldcornerx, $ldcornery, $rdcornerx, $rdcornery, $rdcornerx1, $rdcornery1);
		imagefilledpolygon(&$im,$dots2,8,$whiteT);
		
		//beginWrite coord
		$beginWriteX=$lucornerx1 + $border;
		$beginWriteY=$lucornery + $border-4;// + $heightRow/2;
		
		
		$teext=wordwrap($text,$poz,"\n",true);
		$text=strtok($teext,"\n");
		
		while($text !== false)
		{
			imagestring(&$im, $fontID, $beginWriteX, $beginWriteY, $text, $black);
			$beginWriteY=$beginWriteY+$heightRow;
			$text=strtok("\n");
		}	
		
	}
}	
		








?>