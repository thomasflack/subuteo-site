<?php

class testDb {
    private $servername;
    private $username;
    private $password;
    private $dbName;

    public function testDb ($servername, $username, $password, $dbName)
    {
        if (!is_string($servername)) {
            error_log(
                sprintf(
                    '%s:%s - Servername %s is not a string.',
                    __FILE__, __LINE__, var_export($servername, true)
                )
            );
            return;
        }

        if (!is_string($username)) {
            error_log(
                sprintf(
                    '%s:%s - Username %s is not a string.',
                    __FILE__, __LINE__, var_export($username, true)
                )
            );
            return;
        }

        if (!is_string($password)) {
            error_log(
                sprintf(
                    '%s:%s - Password %s is not a string.',
                    __FILE__, __LINE__, var_export($password, true)
                )
            );
            return;
        }

        if (!is_string($dbName)) {
            error_log(
                sprintf(
                    '%s:%s - DB Name %s is not a string.',
                    __FILE__, __LINE__, var_export($dbName, true)
                )
            );
            return;
        }

        $this->servername = $servername;
        $this->username   = $username;
        $this->password   = $password;
        $this->dbName     = $dbName;
    }

    public function query ($query)
    {
        if (!is_string($query)) {
            error_log(
                sprintf(
                    '%s:%s - Query %s is not a string.',
                    __FILE__, __LINE__, var_export($query, true)
                )
            );
            return;
        }

        $dbConn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);

        if ($dbConn->connect_error) {
            die(sprintf('Connection failed: %s', $dbConn->connect_error));
        }

        $result = $dbConn->query($query);

        $dbConn->close();

        return $result;
    }
}

