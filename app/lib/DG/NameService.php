<?php namespace DG\Service;

use DG\Repository\NameRepository;

class NameService
{
    public function __construct(NameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validate($name = null)
    {
        if (is_null($name) === true) {
            return false;
        }

        if (empty($name) === true) {
            return false;
        }

        $name = strtolower($name);

        return preg_match('/[a-z]{1,}mann?$/', $name) === 0 ? false : true;
    }
}