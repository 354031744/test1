<?php 
class Sign
{
    public static  function productSign($dataArray,$key){
        $signString = "";
        ksort($dataArray);
        foreach ($dataArray as $x => $x_value) {
            if($x_value == "" || $x_value == null)
                continue;
            $signString = $signString . $x . "=" . $x_value . "&";
        }
        $signString = $signString . "key=".$key;
        return strtoupper(md5($signString));

    }
}