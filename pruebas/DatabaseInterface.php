
<?php
interface DatabaseInterface {
    public function query($sql);
    public function insert_id();
}
?>
