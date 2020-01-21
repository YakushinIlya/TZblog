<?php

namespace App\Helpers\Contracts;

interface NavigationCntr {

    public static function select($loc);
    public static function create($datd);
    public static function update($id, $loc);
    public static function delete($id);

}