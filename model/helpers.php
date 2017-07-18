<?php

/**
 * Raccourci un texte ou une ligne de caractères
 */
function shortenText($string){
    return substr($string,0,200);
}

function reformatDate($sqlDateString){
    $phpdate = strtotime($sqlDateString);
    return date('d/m/Y à H:i',$phpdate);
}


/**
 * @param $ptime
 * @return string
 *
 */
function time_elapsed_string($sqlDateString)
{
    $ptime = strtotime($sqlDateString);
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'an',
        30 * 24 * 60 * 60  =>  'mois',
        24 * 60 * 60  =>  'jours',
        60 * 60  =>  'heure',
        60  =>  'minute',
        1  =>  'seconde'
    );
    $a_plural = array( 'an'   => 'années',
        'mois'  => 'mois',
        'jours'    => 'jours',
        'heure'   => 'heures',
        'minute' => 'minutes',
        'seconde' => 'secondes'
    );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str);
        }
    }
}

function gravatar($email){
    return md5(strtolower(trim($email)));
}

