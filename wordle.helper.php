<?php

$all_words = array();
$counter = 0;
$handle = fopen("5HarfliKelimeler.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $all_words[$counter] = replace_turkish_characters(strtolower(str_replace("\r\n", "", $line))); // process the line read.
        $counter++;
    }
    fclose($handle);
} else {
    // error opening the file.
}



function replace_turkish_characters($text)
{
    return str_replace(
        "Ç",
        "C",
        str_replace(
            "ç",
            "c",
            str_replace(
                "Ğ",
                "G",
                str_replace(
                    "ğ",
                    "g",
                    str_replace(
                        "ı",
                        "i",
                        str_replace(
                            "Ü",
                            "U",
                            str_replace(
                                "ü",
                                "u",
                                str_replace(
                                    "Ş",
                                    "S",
                                    str_replace(
                                        "ş",
                                        "s",
                                        str_replace(
                                            "Ö",
                                            "O",
                                            str_replace(
                                                "ö",
                                                "o",
                                                str_replace("İ", "I", $text)
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            )
        )
    );
}

$t1 = $t2 = $t3 = $t4 = $t5 = $ignore = "";

if ($_POST) {


    // $alphabe = array("B", "C", "Ç", "D", "E", "F", "G", "H", "I", "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T", "U", "Ü", "V", "Y", "Z",);
    // $url1 = 'https://kelimeler.net/a-ile-baslayan-5-harfli-kelimeler';
    // $content = file_get_contents($url1);

    // for ($i = 0; $i < count($alphabe); $i++) {
    //     $url1 = 'https://kelimeler.net/' . $alphabe[$i] . '-ile-baslayan-5-harfli-kelimeler';
    //     $content .= file_get_contents($url1);
    // }


    // // $url2 = 'https://kelimeler.net/b-ile-baslayan-5-harfli-kelimeler';
    // // $content = $content . file_get_contents($url2);

    // // $url3 = 'https://kelimeler.net/c-ile-baslayan-5-harfli-kelimeler';
    // // $content = $content . file_get_contents($url3);

    // $doc = new DOMDocument();
    // @$doc->loadHTML($content);
    // $xpath = new DOMXPath($doc);
    // $elements = $xpath->query("//ul[@class='monospace']//li//a");

    // var_dump( $all_words);

    $t1 = strtolower($_POST["t0"]);
    $t2 = strtolower($_POST["t1"]);
    $t3 = strtolower($_POST["t2"]);
    $t4 = strtolower($_POST["t3"]);
    $t5 = strtolower($_POST["t4"]);
    if (isset($_POST["chk1"]))
        $chk1 =  $_POST["chk1"];
    $ignore = strtolower($_POST["ignore"]);
}

//var_dump($_POST);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='text/html; charset=ISO-8859' http-equiv='Content-Type' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859" />

    <title> </title>
    <meta name="author" content="Mustafa">
</head>
</body>
<form action="" method="POST">
    <input type="text" name="t0" value="<?= $t1 ?>" style="width:50px;" placeholder="Harf" />
    <input type="text" name="t1" value="<?= $t2 ?>" style="width:50px;" placeholder="Harf" />
    <input type="text" name="t2" value="<?= $t3 ?>" style="width:50px;" placeholder="Harf" />
    <input type="text" name="t3" value="<?= $t4 ?>" style="width:50px;" placeholder="Harf" />
    <input type="text" name="t4" value="<?= $t5 ?>" style="width:50px;" placeholder="Harf" />
    <br>
    <br>
    <input type="text" name="ignore" value="<?= $ignore ?>" placeholder="Kelime İçinde Olmayacaklar. Aralara Virgül Atın" style="width:300px;" />
    <br>
    <br>
    <label for="chk1"> Yerleri Doğru Olsun </label>
    <input type="checkbox" name="chk1" id="chk1" />
    <label for="chk1"> (İşaretli ise ignore çalışmaz) </label>
    <br>
    <br>
    <button type="submit">submit</button>
</form>

<br>

<?php
$ok = 0;
$ignored = 0;
if ($_POST) {
    $kontrol = array(0, 0, 0, 0, 0);

    // for ($i = 0; $i < $elements->length; $i++) {
    for ($i = 0; $i < count($all_words); $i++) {
        // $curr_element = $elements->item($i);
        // $word =  strtoupper($curr_element->nodeValue);
        $word =  strtolower($all_words[$i]);
        $ignored = 0;
        $kontrol = array(0, 0, 0, 0, 0);
        if (isset($_POST["chk1"]) && $_POST["chk1"] == "on") {

            for ($j = 0; $j < 5; $j++) {
                $giris = $_POST["t" . $j];
                $harf = $word[$j];

                if ($giris == "" ||  $giris == "*") {
                    $kontrol[$j] = 1;
                } else {
                    if ($harf  ==   $giris) {
                        $kontrol[$j] = 1;
                    } else {
                        $kontrol[$j] = 0;
                    }
                }
            }

            if ($kontrol[0] == 1 && $kontrol[1] == 1 && $kontrol[2] == 1 && $kontrol[3] == 1 && $kontrol[4] == 1) {
                $kontrol = array(0, 0, 0, 0, 0);
                echo   $word  . "<br/>";
            }
        } else {

            if ($ignore != "") {
                $ignoring = explode(",", $ignore);
                for ($ii = 0; $ii < count($ignoring); $ii++) {
                    // Aranan harf 0. karakter ise  == işleci beklendiği gibi
                    // çalışmayacaktır. Bu yüzden === kullanmaya çalışın.
                    if (strpos($word, $ignoring[$ii]) === false) {
                    } else {
                        $ignored = 1;
                    }
                    if (strpos($word, $ignoring[$ii]) != false) {
                        $ignored = 1;
                    } else {
                    }
                }
            }
            //  var_dump( $ignoring );

            if ($ignored == 0) {
                if (strlen($t1) == 0 && strlen($t2) == 0 && strlen($t3) == 0 && strlen($t4) == 0 && strlen($t5) == 0) {
                    echo   $word  . "<br/>";
                }
                if (strlen($t1) == 1 && strlen($t2) == 0 && strlen($t3) == 0 && strlen($t4) == 0 && strlen($t5) == 0) {
                    if (strpos($word, $t1)) echo   $word  . "<br/>";
                    else echo "";
                }
                if (strlen($t1) == 1 && strlen($t2) == 1 && strlen($t3) == 0 && strlen($t4) == 0 && strlen($t5) == 0) {
                    if (strpos($word, $t1) && strpos($word, $t2)) echo   $word  . "<br/>";
                    else echo "";
                }
                if (strlen($t1) == 1 && strlen($t2) == 1 && strlen($t3) == 1 && strlen($t4) == 0 && strlen($t5) == 0) {
                    if (strpos($word, $t1) && strpos($word, $t2) && strpos($word, $t3)) echo   $word  . "<br/>";
                    else echo "";
                }
                if (strlen($t1) == 1 && strlen($t2) == 1 && strlen($t3) == 1 && strlen($t4) == 1 && strlen($t5) == 0) {
                    if (strpos($word, $t1) && strpos($word, $t2) && strpos($word, $t3) && strpos($word, $t4)) echo   $word  . "<br/>";
                    else echo "";
                }
                if (strlen($t1) == 1 && strlen($t2) == 1 && strlen($t3) == 1 && strlen($t4) == 1 && strlen($t5) == 1) {
                    if (strpos($word, $t1) && strpos($word, $t2) && strpos($word, $t3) && strpos($word, $t4) && strpos($word, $t5)) echo   $word  . "<br/>";
                    else echo "";
                }
            } else {
                // ignore  word
            }
        }
    }
}



?>

<body>

</html>