<?php

namespace TurOnline;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\VarDumper\Cloner\Data;

class RegisterQrAccess extends Model
{
//    protected $table = 'registroqrcodes';


    protected $fillable = [
        'navegador', 'ipclient'
    ];

    /*
     * return Dados pronto para passar como parâmetro para o create
     */
    public function dados()
    {
        $data = [
            'navegador' => ($this->navegador?$this->navegador:'naodeu'),
            'ipclient' => $this->getIpClient()
        ];
        return $data;
    }

    /**
     * @return array
     */
    protected function getIpClient()
    {
        $ip = \Request::ip();

        return $ip;
    }


    /*
     * @return data e hora atual
     */

    private function getDateTime()
    {
        $data = date('Y-m-d H:i:s');

        return $data;
    }














    //era pra pegar o navegador, mas não está funcionando

    public function getNavegador()
    {
//      $ip = $_SERVER['REMOTE_ADDR'];

        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'Linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'Mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'Windows';
        }


        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/AppleWebKit/i', $u_agent)) {
            $bname = 'AppleWebKit';
            $ub = "Opera";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
        }


        $i = count($matches['browser']);
        if ($i != 1) {
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        $Browser = array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern
        );

        $navegador = "Navegador: " . $Browser['name'] . " " . $Browser['version'];
        $so = "SO: " . $Browser['platform'];

        dd($navegador);
//        return $request;
    }


}
