<?php
	function freq($word) {
		$characterArray=[];
		$aLetter=str_split($word);
		foreach($aLetter as $v)	{
			if(array_key_exists($v,$characterArray)) {
				$characterArray[$v]++;
			} else {
				$characterArray[$v]=1;
			}
		}
		return $characterArray;
	}

	function isAnagram($word1,$word2) {
		$c1=freq($word1);
		$c2=freq($word2);
		foreach($c2 as $k => $v) {
			if(!array_key_exists($k,$c1) || $c1[$k]<$v) {
				return false;
			}
		}
		return true;
	}	
	
	function getAnagrams($word,$dictionary) {
		$aLetter=[];
		foreach($dictionary as $w) {
			if(isAnagram($word,$w)) {
				$aLetter[]=$w;
			}
		}
		return $aLetter;
	}

	function filterWords($dictionary,$minLetters,$maxLetters) {
		$aLetter=[];
		foreach($dictionary as $w) {
			$lengthOfWord=strlen($w);
			if($lengthOfWord>=$minLetters && $lengthOfWord<=$maxLetters) {
				$aLetter[]=$w;
			}
		}
		return $aLetter;
	}

	$dictionary=file('dictionary.txt',FILE_IGNORE_NEW_LINES);
	$dictionary=filterWords($dictionary,2,7);
	$chosen=filterWords($dictionary,7,7);
	$word=$chosen[array_rand($chosen)];
	$anagrams=getAnagrams($word,$dictionary);
	$result=array('word'=>$word,'anagrams'=>$anagrams);
	echo json_encode($result);
?>