<style>
    form#write_comment p{
        margin: 5px 0px 5px 0px;
    }
    form#write_comment{
        margin-bottom: 5px;
    }
    iframe#comment_list{
        border: 0px;
    }
    div#one_comment{
        margin-top: 15px;
        margin-bottom: 15px;
        margin-right: 50%;
    }
    p#Comment_Text{
        margin-left: 30px;
        margin-bottom: 10px;
    }
    button#submit{
        margin-top: 5px;
        margin-bottom: 5px;
    }
</style>

<?php
    $szj = array("", "egy", "kettő", "három", "négy", "öt", "hat", "hét", "nyolc", "kilenc");
    $ca = rand( 1, 9);
    $cb = rand(2, 9);
    $cc = $ca + $cb;
    $_SESSION['cc'] = 10 + $ca + $cb;
?>

<form action='vendegkonyv_ir.php' method='post' id='write_comment' target='kisablak' enctype="multipart/form-data">
    <p>Név:</p> <input type='text' id='nev' name='comment_name'>
    <br>
    <p>Szöveg</p> 
    <textarea id='comment' cols='40' rows='8' name='comment_text'></textarea>
    <br>
    <input type="file" name="comment_file">
    <br>
    Mennyi tizen<?=$szj[$ca]?> + <?=$szj[$cb]?>? <input type="captcha" maxlength="2" name='Captcha'>
    <br>
    <button type='submit' id="submit">Beküldés</button>
</form>

<?php//Az oldal betöltésekor kiírás
    $file_comments = explode("\r\n", file_get_contents("all_comments.txt", false));
    $file_comments = array_reverse($file_comments);

    foreach($file_comments as $oneline)//Új kommentnél frissítés az új listára
    {
        if(strlen($oneline) > 2)
        {
            $one_comment = explode(";", $oneline);
            if($one_comment[3] != "")//Ha van csatolmány
            {
                $one_comment[3] = "<p align='right'><a href='./files/$one_comment[4]' target=_blank>Csatolt fájl</a></p>";
            }
            else//Ha nincs csatolmány
            {
                $one_comment[3] = "<p align='right'>Nincs csatolmány</p>";
            }
            print("<div id='one_comment'>
                    <h4 id='Comment_Header'>".$one_comment[1]." | ".$one_comment[0]."</h4>
                    <p id='Comment_Text'>".$one_comment[2]."</p><br>
                    ".$one_comment[3]."
                    <hr>
                   </div>\r\n");
        }
    }
?>