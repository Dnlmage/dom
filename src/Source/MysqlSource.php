<?php

namespace engldom\Source;

use engldom\DbConnect;
use engldom\Common\SourceInterface;
use yii\db\Exception;

/**
 * Class MysqlSource
 * @package engldom\Source
 */
class MysqlSource implements SourceInterface
{

    /**
     * @var null
     */
    public static $instance = null;

    /**
     *
     * @return MysqlSource
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    /**
     * @var string
     */
    protected $dsn = '';


    /**
     * @var string
     */
    protected $database = '';


    /**
     * @var string
     */
    protected $username = '';


    /**
     * @var string
     */
    protected $password = '';


    /**
     * @var string
     */
    protected $charset = '';


    /**
     * @var
     */
    protected $pdo;


    /**
     * @var array
     */
    private $parameters = [];


    /**
     * @var
     */
    private $pQuery;

    /**
     * MysqlSource constructor.
     */
    public function __construct()
    {
    }

    /**
     *
     */
    public function __clone()
    {
    }

    /**
     * @return mixed
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param mixed $database
     */
    public function setDatabase($database)
    {
        $this->database = $database;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $charset
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    /**
     * @param mixed $dsn
     */
    public function setDsn($dsn)
    {
        $this->dsn = $dsn;
    }

    /**
     * @return mixed
     */
    public function getDsn()
    {
        return $this->dsn;
    }

    /**
     *
     */
    public function connect()
    {
        $connectData = DbConnect::getConnect();
        $this->setDsn($connectData['dsn']);
        $this->setUsername($connectData['username']);
        $this->setPassword($connectData['password']);
        $this->setCharset($connectData['charset']);

        try {
            $this->pdo = new \PDO($this->getDsn(),
                $this->getUsername(),
                $this->getPassword()
            );
        } catch (PDOException $e) {
            throw new Exception();
        }
    }

    /**
     *
     */
    public function diconnect()
    {
        $this->pdo = null;
    }

    /**
     * @param $query
     * @param null $params
     * @param int $fetchmode
     * @return null
     */
    public function query($query, $params = null, $fetchmode = \PDO::FETCH_ASSOC)
    {
        if (!$this->pdo) {
            $this->connect();
        }
        $query = trim(str_replace("\r", " ", $query));

        $this->init($query, $params);

        $rawStatement = explode(" ", preg_replace("/\s+|\t+|\n+/", " ", $query));

        $statement = strtolower($rawStatement[0]);

        if ($statement === 'select' || $statement === 'show') {
            return $this->pQuery->fetchAll($fetchmode);
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->pQuery->rowCount();
        } else {
            return null;
        }
    }

    /**
     * @param $query
     * @param string $parameters
     */
    private function init(string $query, $parameters = "")
    {
        try {
            $this->pQuery = $this->pdo->prepare($query);
            $this->bindMore($parameters);

            if (!empty($this->parameters)) {
                foreach ($this->parameters as $param => $value) {
                    if (is_int($value[1])) {
                        $type = \PDO::PARAM_INT;
                    } else {
                        if (is_bool($value[1])) {
                            $type = \PDO::PARAM_BOOL;
                        } else {
                            if (is_null($value[1])) {
                                $type = \PDO::PARAM_NULL;
                            } else {
                                $type = \PDO::PARAM_STR;
                            }
                        }
                    }

                    $this->pQuery->bindParam($value[0], $value[1], $type);
                }
            }

            $this->pQuery->execute();
        } catch (PDOException $e) {
        }

        $this->parameters = array();
    }

    /**
     * @param $parray
     */
    public function bindMore($parray)
    {
        if (empty($this->parameters) && is_array($parray)) {
            $columns = array_keys($parray);
            foreach ($columns as $i => &$column) {
                $this->bind($column, $parray[$column]);
            }
        }
    }

    /**
     * @param $para
     * @param $value
     */
    public function bind($para, $value)
    {
        $this->parameters[sizeof($this->parameters)] = [":" . $para, $value];
    }
}
