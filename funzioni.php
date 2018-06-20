<?php

class MysqlClass {

    // variabili per la connessione al database

	//$ip = $_SERVER["REMOTE_ADDR"];
       private $nomehost = "46.252.157.14";
    private $nomeuser = "yhtniqqq_martino";
    private $password = "martino281089.";
    private $nomedb = "yhtniqqq_balbi"; 

    // controllo sulle connessioni attive
    private $attiva = false;

    // funzione per la connessione a MySQL
    public function connetti() {
        if (!$this->attiva) {
            if ($connessione = mysql_connect($this->nomehost, $this->nomeuser, $this->password) or die(mysql_error())) {
                $selezione = mysql_select_db($this->nomedb, $connessione) or die(mysql_error());
                mysql_set_charset('utf8');
            }
        } else {
            return true;
        }
    }

//funzione per l'esecuzione delle query 
    public function query($sql) {
        if (isset($this->attiva)) {
            $sql = mysql_query($sql) or die(mysql_error());
            return $sql;
        } else {
            return false;
        }
    }

//funzione per l'inserimento dei dati in tabella
    public function inserisci($t, $v, $r = null) {
        if (isset($this->attiva)) {
            $istruzione = 'INSERT INTO ' . $t;
            if ($r != null) {
                $istruzione .= ' (' . $r . ')';
            }

            for ($i = 0; $i < count($v); $i++) {
                if (is_string($v[$i]))
                    $v[$i] = '"' . $v[$i] . '"';
            }
            $v = implode(',', $v);
            $istruzione .= ' VALUES (' . $v . ')';

            $query = mysql_query($istruzione) or die(mysql_error());
        }else {
            return false;
        }
    }

//funzione per l'estrazione dei record 
    public function estrai($risultato) {
        if (isset($this->attiva)) {
            $r = mysql_fetch_object($risultato);
            return $r;
        } else {
            return false;
        }
    }

    // funzione per la formattazione della data
    public function format_data($d) {
        $veto = explode(" ", $d);
        $data = $veto[0];
        $vet = explode("-", $data);
        $df = $vet[2] . "/" . $vet[1] . "/" . $vet[0];
        if ($df == "00/00/0000" || $df == "//") {
            $df = "";
        }
        return $df;
    }

    public function format_data_ora($d) {
        $veto = explode(" ", $d);
        $data = $veto[0];
        $ora = $veto[1];
        $vet = explode("-", $data);
        $df = $vet[2] . "/" . $vet[1] . "/" . $vet[0];
        if ($df == "00/00/0000" || $df == "//") {
            $df = "";
        } else {
            $df = $df . ' alle ' . $ora;
        }
        return $df;
    }

// funzione per la chiusura della connessione
    public function disconnetti() {
        if ($this->attiva) {
            if (mysql_close()) {
                $this->attiva = false;
                return true;
            } else {
                return false;
            }
        }
    }

}

?>