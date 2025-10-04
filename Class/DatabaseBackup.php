<?php

class DatabaseBackup extends Database {

    const TABLE_NAME = 'database_backups';
    const COLUMNS = [
        'id',
        'file_name',
        'file_path',
        'file_size',
    ];
    const DATABASE_DUMP_DIR = '../../database_dumps/';

    private $id;
    private $file_name;
    private $file_path;
    private $file_size;

    public function __construct() {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFileName($file_name) {
        $this->file_name = $file_name;
    }

    public function setFilePath($file_path) {
        $this->file_path = $file_path;
    }

    public function setFileSize($file_size) {
        $this->file_size = $file_size;
    }

    function generateDatabaseDump(): bool {
        $filename = 'backup_' . date('Ymd_His') . '.sql';
        $mysql_dump_path = 'C:\xampp\mysql\bin\mysqldump.exe';

        // --no-data option to exclude data, only structure
        // --no-create-info option to exclude table creation statements

        $command = sprintf(
            '%s -h %s -u %s %s > %s',
            escapeshellarg($mysql_dump_path),
            escapeshellarg($this->getHost()),
            escapeshellarg($this->getUsername()),
            escapeshellarg($this->getDatabaseName()),
            escapeshellarg(self::DATABASE_DUMP_DIR . $filename)
        );

        exec($command, $output, $return_var);

        if ($return_var === 0) {
            $this->saveBackupRecord($filename);
            return true;
        } else {
            error_log("Database dump failed. Command: $command. Return Code: $return_var. Output: " . implode("\n", $output));
            return false;
        }
    }

    public function saveBackupRecord($file_name) {

        $filesize = filesize('../../database_dumps/' . $file_name);
        return $this->sqlInsert([
            'file_name' => $file_name,
            'file_path' => 'database_dumps/' . $file_name,
            'file_size' => $filesize,
        ]);
    }

    public function getBackups(){
        return $this->sqlSelect([
                self::TABLE_NAME.'.id',
                self::TABLE_NAME.'.file_name',
                self::TABLE_NAME.'.file_path',
                self::TABLE_NAME.'.file_size',
                self::TABLE_NAME.'.date_created',
            ])->getAll();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}