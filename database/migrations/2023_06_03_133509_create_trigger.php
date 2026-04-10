<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = '
            CREATE TRIGGER my_trigger AFTER DELETE ON acceptes
            FOR EACH ROW
            BEGIN
                -- Trigger logic goes here
                DECLARE id_livre_deleted INT;
                SET id_livre_deleted = OLD.id_livre;
                UPDATE livres SET NBR_COPIES = NBR_COPIES + 1 WHERE id = id_livre_deleted;
            END
        ';

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = 'DROP TRIGGER IF EXISTS my_trigger';
        DB::unprepared($sql);
    }
};
