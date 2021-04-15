<?php


namespace PHPMVC\Lib;


class CostumSessionHandler implements \SessionHandlerInterface
{

    use Helper;

    private $sessionName     = 'mySession';
    private $sessionHttpOnly = true;
    private $sessionPath     = '/';
    private $sessionSSL      = false;
    private $sessionDomain   = 'www.exemple.com';
    private $session_expire;
    private $maxLifeTime;
    private $db_handler;


    public function __construct()
    {
        global $handler;
        $this->db_handler = $handler;
        $this->maxLifeTime = ini_get('session.gc_maxlifetime');

        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_trans_sid', 1);

        session_name($this->sessionName);
        // session_set_cookie_params(
        // 	$this->maxLifeTime,
        // 	$this->sessionPath,
        // 	$this->sessionSSL,
        // 	$this->sessionHttpOnly
        // );

        $this->session_expire = time() + intval($this->maxLifeTime);
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        if ($this->db_handler->inTransaction()) {
            $this->db_handler->commit();
        }
        $this->gc();
        return true;
    }

    /**
     * @inheritDoc
     */
    public function destroy($session_id)
    {
        try {

            $sql = "DELETE FROM sessions WHERE sess_id = :sess_id";
            $deletestmt = $this->db_handler->prepare($sql);
            $deletestmt->bindValue(':sess_id', $session_id);
            $deletestmt->execute();

        } catch (PDOException $e) {
            if ($this->db_handler->inTransaction()) {
                $this->db_handler->rollBack();
            }
        }

        session_unset();
        setcookie(
            $this->sessionName,
            '',
            time() - 1000,
            $this->sessionPath,
            $this->sessionDomain,
            $this->sessionSSL,
            $this->sessionHttpOnly
        );
        return true;
    }

    /**
     * @inheritDoc
     */
    public function gc($maxlifetime = 0)
    {
        try {

            $sql = "DELETE FROM sessions WHERE expire_date < :current_t";
            $deletestmt = $this->db_handler->prepare($sql);
            $deletestmt->bindValue(':current_t', time(), \PDO::PARAM_INT);
            $deletestmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function open($save_path, $name)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function read($sess_id)
    {
        try {

            $this->db_handler->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
            $this->db_handler->beginTransaction();

            $sql = "SELECT expire_date, data FROM sessions WHERE sess_id = :sess_id FOR UPDATE";

            $read_stmt = $this->db_handler->prepare($sql);
            $read_stmt->execute(array(
                ':sess_id' => $sess_id
            ));
            $read_stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $data = $read_stmt->fetch();

            if ($data) {
                if ($data['expire_date'] < time()) {
                    return '';
                }
                return $this->dehash_data($data['data']);
            }

            return $this->initialize($sess_id);

        } catch (PDOException $e) {
            if ($this->db_handler->inTransaction()) {
                $this->db_handler->rollBack();
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function write($sess_id, $data)
    {
        $data = $this->hash_decrypted_data($data);

        try {

            $sql = "INSERT INTO sessions (sess_id, expire_date, data)
				VALUES (:sess_id, :expire, :data)
				ON DUPLICATE KEY UPDATE data = :data, expire_date = :expire";

            $write_stmt = $this->db_handler->prepare($sql);
            $write_stmt->execute(array(
                ':sess_id' => $sess_id,
                ':data'    => $data,
                ':expire'  => $this->session_expire
            ));

            return true;

        } catch (Exception $e) {

            if ($this->db_handler->inTransaction()) {
                $this->db_handler->rollBack();
            }
        }
    }

    private function initialize($sess_id)
    {
        try {
            $sql = "INSERT INTO sessions (sess_id, expire_date, data)
				VALUES (:sess_id, :expire, :data)";
            $insert_stmt = $this->db_handler->prepare($sql);
            $insert_stmt->bindValue(':expire', $this->session_expire, \PDO::PARAM_INT);
            $insert_stmt->bindValue(':data', '');
            $insert_stmt->bindValue(':sess_id', $sess_id);
            $insert_stmt->execute();
            return '';
        } catch (PDOException $e) {
            if ($this->db_handler->inTransaction()) {
                $this->db_handler->rollBack();
            }
            echo $e->getMessage();
        }

    }
}