<?php
//comunica al client che a risposta è in formato json
header("Content-Type: application/json");
//abiltà l'accesso a qualsiasi sito
header("Access-Control-Allow-Origin: *");

//simulazione db
$squadre = [
    ["id" => 1, "nome" => "Juventus", "citta" => "Torino", "trofei" => 70],
    ["id" => 2, "nome" => "AC Milan", "citta" => "Milano", "trofei" => 49],
    ["id" => 3, "nome" => "Staffolo", "citta" => "Staffolo", "trofei" => 60],
    ["id" => 4, "nome" => "Napoli", "citta" => "Napoli", "trofei" => 14],
    ["id" => 5, "nome" => "Lazio", "citta" => "Roma", "trofei" => 16]
];

//dimmi il codice per fare l'istradamento del path
$path = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';
$azione = ($path === '') ? 'tutte' : $path;

//swich per scegliere l'opzione
switch($azione) {
    case 'tutte':
        echo json_encode($squadre);
        break;

    case 'vincenti':
        $filtrati = array_values(array_filter($squadre, function($s) {
            return $s['trofei'] > 50;
        }));
        echo json_encode($filtrati);
        break;

    default:
        http_response_code(404);
        echo json_encode(["errore" => "Rotta non trovata"]);
        break;
}
?>