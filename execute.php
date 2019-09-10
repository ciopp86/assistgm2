<?php
$botToken = "903203803:AAGyVhkEsNITBDmBUgRyCfE2p5IWbbn45SY";




$website = "https://api.telegram.org/bot".$botToken;
$update = file_get_contents("php://input");
$update = json_decode($update, TRUE);
$chatId = $update['message']['from']['id'];
$nome = $update['message']['from']['first_name'];
$text = $update['message']['text'];
$agg = json_encode($update,JSON_PRETTY_PRINT);
switch($text)
{
	case "/start":
		sendMessage($chatId,"Ciao <b>$nome</b>! Premi il tasto HOME per tornare al menù principale.",$tastierabenvenuto);
		break;
	case "INFORMAZIONI":
		sendMessage($chatId,"Verrai ricontattato da un nostro consulente",$tastierabenvenuto);
		break;
	case "ASSISTENZA":
		sendMessage($chatId,"Quale problema riscontri?",$tastierabenvenuto);
		break;
	case "IDCHAT":
		sendMessage($chatId,"<b>$chatId</b>",$tastierabenvenuto);
		break;	
	default:
		$tastierabenvenuto = '["INFORMAZIONI"],["ASSISTENZA"],["HOME"],["IDCHAT"]';
		sendMessage($chatId,"Ciao <b>$nome</b>! Sono il tuo assistente GM Stream, in cosa posso esserti utile?",$tastierabenvenuto);
	break;
}
function sendMessage($chatId,$text,$tastiera)
{
	if(isset($tastiera))
	{
		$tastierino = '&reply_markup={"keyboard":['.$tastiera.'],"resize_keyboard":true}';
	}
	$url = $GLOBALS[website]."/sendMessage?chat_id=$chatId&parse_mode=HTML&text=".urlencode($text).$tastierino;
	file_get_contents($url);
}
?>
