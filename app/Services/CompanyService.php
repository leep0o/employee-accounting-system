<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Comment;

class CompanyService
{
    /**
     * @var Company
     */
    private $company;

    /**
     * @var Comment
     */
    private $comment;

    /**
     * CompanyService constructor.
     * @param Company $company
     * @param Comment $comment
     */
    public function __construct(Company $company, Comment $comment)
    {
        $this->company = $company;
        $this->comment = $comment;
    }

    /**
     * List of companies
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function companyList()
    {
        return $this->company->with([
            'users' => function ($query) {
                $query->with('position');
            }
        ])->paginate(10);
    }

    /**
     * Show company
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function showCompany(int $id)
    {
        return $this->company->with([
            'users' => function ($query) {
                $query->with('position');
            },
            'comments' => function ($query) {
                $query->with('owner');
            }
        ])->find($id);
    }

    /**
     * Update data company
     *
     * @param $request
     * @return mixed
     */
    public function storeCompany($request)
    {
        $company = $this->company->find(\Auth::id());

        if ($request->image) {
            $company->clearMediaCollection('image');
            $company->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return $company->update($request->all());
    }

    /**
     * Delete company
     *
     * @return mixed
     */
    public function deleteCompany()
    {
        $company = $this->company->find(\Auth::id());

        \Auth::logout();

        return $company->delete();
    }

    /**
     * Get employee
     *
     * @param int $id
     * @return mixed
     */
    public function getEmployee(int $id)
    {
        return \Auth::user()->users()->find($id);
    }

    /**
     * Store employee data
     *
     * @param array $data
     * @return mixed
     */
    public function storeEmployee(array $data)
    {
        if ($data['id']) {
            $employee = $this->getEmployee($data['id']);
            $employee->update($data);
        } else {
            $employee = \Auth::user()->users()->create($data);
        }

        return $employee->position()->associate($data['position'])->save();
    }

    /**
     * Delete employee
     *
     * @param int $id
     * @return mixed
     */
    public function deleteEmployee(int $id)
    {
        return $this->getEmployee($id)->delete();
    }

    /**
     * Add comment
     *
     * @param array $data
     * @return mixed
     */
    public function addComment(array $data)
    {
        $company = $this->company->find($data['company_id']);
        $comment = $this->comment->create(['body' => $data['comment']]);

        return $company->comments()->save($comment);
    }
}
