<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["Logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["Login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Campo RFC está vacío, .";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Campo Password está vacío.";
        }

      {


            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                $user_password = $this->db_connection->real_escape_string($_POST['user_password']);


                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                $sql = "SELECT *
                        FROM user
                        WHERE user_name = '". $user_name. "' ;";
                        #AND user_password = '". $user_password."' ;";
                        #AND user_key = '".$user_key."';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1) {
                  //Trae todos los datos de la BD de un registro
                  $result_row = $result_of_login_check->fetch_object();
                    //Variable de Password en la BD
                    $DBPassword = $result_row->user_password;

                    if ($user_password == $DBPassword) {
                      //Variable de Status en la BD
                      $DBStatus = $result_row->user_status;

                      if ($DBStatus == 1) {

                            #$result_row = $result_of_login_check->fetch_object();

                            $_SESSION['user_id'] = $result_row->user_id;
                            $_SESSION['user_name'] = $result_row->user_name;
                            $_SESSION['user_login_status'] = 1;


                      }else {
                        $this->errors[] = "No posees permisos para acceder";
                      }

                    }else {
                      $this->errors[] = "La contraseña no es correcta";
                    }

                } else {
                    $this->errors[] = "El usuario no existe";

                }
            } else {
                $this->errors[] = "Problema de conexión de base de datos.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();

        // return a little feeedback message
        $this->messages[] = "Has sido desconectado.";
    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }


}
