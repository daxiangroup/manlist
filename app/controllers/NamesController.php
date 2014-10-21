<?php

use DG\Repository\NameRepository;
use DG\Service\NameService;

class NamesController extends BaseController {

    private $nameRespository;
    private $nameService;

    public function __construct(NameRepository $repository, NameService $service)
    {
        $this->nameRepository = $repository;
        $this->nameService    = $service;
    }

    public function getIndex()
    {
        return $this->getList();
    }

    public function postIndex()
    {
        $name = ucfirst(Input::get('field-name-add'));

        if ($this->nameService->validate($name) === false) {
            return Redirect::route('names.list')
                ->with('err', 'Inavlid name: '.$name);
        }

        if ($this->nameRepository->exists($name) === true) {
            return Redirect::route('names.list')
                ->with('err', '"'.$name.'" already exists - It was not added again');
        }

        if ($this->nameRepository->save($name) === false) {
            return Redirect::route('names.list')
                ->with('err', 'Save failed: '.$name);
        }

        $redirectLetter = strtolower(substr($name, 0, 1));

        return Redirect::route('names.list', array($redirectLetter))
            ->with('notice', '"'.$name.'" was succesfully added!');
    }

    public function getList($letter = 'a')
    {
        $letter = strtolower($letter);

        preg_match('/^[a-z]{1}$/', $letter, $matches);

        if (empty($matches) === true) {
            return Redirect::route('names.list', 'a');
        }

        $names = DB::table('the_names')
            ->where('name', 'like', $letter.'%')
            ->orderBy('name')
            ->get();

        $totalNames = DB::table('the_names')->count();

        return View::make('list')
            ->with('letter', $letter)
            ->with('names', $names)
            ->with('totalNames', $totalNames)
            ->with('highlight', Session::get('new-name', ''));
    }
}
