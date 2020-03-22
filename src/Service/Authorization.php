<?php

namespace App\Service;

class Authorization {

    private $database;

    public function Register($data) {

    }

    public function Login($data) {

    }

    public function Exit($data) {

    }

    public function CheckUser($data) {

        /*if(isset($_COOKIE['htoken']) == true)
        {
            $conection = mysql_connect('localhost', 'd98413ws_bd1', 'SaviouR996611');
            mysql_select_db('d98413ws_bd1', $conection);
            $result = mysql_query("SELECT * FROM wot_User");
            
            $i = 0;
            $col = 0;
            while($bd_array = mysql_fetch_array($result))
            {
                $i += 1;
                if($bd_array['wot_UserToken'] == $_COOKIE['htoken'])
                {
                    $col -= $i;
                    break;
                }
                else
                {
                    $col += 1;
                }
            }
            if($col > 0) // если не нашел в базе по кукам то удаляем куки у пользователя на компе, а значит он должен будет выполнить вход, и скорее всего автоматическую регистрацию заново =/
            {
            setcookie('htoken', '', time()-1209600,'/', 'wotreel.ru');
            }
            mysql_close($conection);
        }*/

    }
}
