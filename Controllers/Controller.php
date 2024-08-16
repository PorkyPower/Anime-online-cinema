<?php
class Controller
{

    private $CFG = array(
        'DB_HOST'      		=> 'localhost',
        'DB_PORT'      		=> '3306',
        'DB_DATABASE'  		=> 'main',
        'DB_USERNAME'  		=> '',
        'DB_PASSWORD'  		=> ''
    );

    private $DB ;

    public function __construct()
    { 
        $constr = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8',
        $this->CFG['DB_HOST'], $this->CFG['DB_PORT'], $this->CFG['DB_DATABASE']);
        $this->DB = new PDO($constr, $this->CFG['DB_USERNAME'], $this->CFG['DB_PASSWORD']);

    }

    public function Query($sql, $params)
    {
        $sth = $this->DB->prepare($sql);
        $sth->execute($params);
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return ($result);
    }
}
