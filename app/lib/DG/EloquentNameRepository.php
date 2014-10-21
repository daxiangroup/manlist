<?php namespace DG\Repository;

use \DB;
use \Session;

class EloquentNameRepository implements NameRepository
{
    public function save($name)
    {
        if (is_null($name) === true) {
            throw new UnexpectedValueException(__CLASS__.'::'.__METHOD__.' - $name cannot be null');
        }

        if (empty($name) === true) {
            throw new UnexpectedValueException(__CLASS__.'::'.__METHOD__.' - $name cannot be empty');
        }

        DB::table(NameRepository::DATABASE.".".NameRepository::TABLE)
            ->insert(
                array('id' => DB::raw('NULL'), 'name' => $name, 'date_added' => DB::raw('NOW()'))
            );

        Session::flash('new-name', $name);

        return true;
    }

    public function exists($name)
    {
        if (is_null($name) === true) {
            throw new UnexpectedValueException(__CLASS__.'::'.__METHOD__.' - $name cannot be null');
        }

        if (empty($name) === true) {
            throw new UnexpectedValueException(__CLASS__.'::'.__METHOD__.' - $name cannot be empty');
        }

        $result = DB::table(NameRepository::DATABASE.".".NameRepository::TABLE)
            ->select('id')
            ->where('name', $name)
            ->get();

        return count($result) > 0;
    }
}