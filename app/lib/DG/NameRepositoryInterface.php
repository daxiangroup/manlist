<?php namespace DG\Repository;

interface NameRepository
{
    const TABLE = 'the_names';
    const DATABASE = 'man_list';

    public function save($name);
    public function exists($name);
}