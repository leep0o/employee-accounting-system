<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Http\Requests\ShowCompanyRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\DeleteEmployeeRequest;


class CompanyController extends Controller
{
    /**
     * @var CompanyService
     */
    private $companyService;

    /**
     * CompanyController constructor.
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * List of companies
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function companyList()
    {
        return view('welcome', [
            'companies' => $this->companyService->companyList()
        ]);
    }

    /**
     * Show company
     *
     * @param ShowCompanyRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCompany(ShowCompanyRequest $request)
    {
        return view('company', [
            'company' => $this->companyService->showCompany($request->id)
        ]);
    }

    /**
     * Update data company
     *
     * @param StoreCompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCompany(StoreCompanyRequest $request)
    {
        $this->companyService->storeCompany($request);

        return redirect()->back();
    }

    /**
     * Delete company
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteCompany()
    {
        $this->companyService->deleteCompany();

        return redirect('/');
    }

    /**
     * Add employee
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addEmployee()
    {
        return view('formEmployee', [
            'positions' => Position::all()->pluck('name', 'id')
        ]);
    }

    /**
     * Edit employee data
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editEmployee(Request $request)
    {
        return view('formEmployee', [
            'user' =>  $this->companyService->getEmployee($request->id),
            'positions' => Position::all()->pluck('name', 'id'),
        ]);
    }

    /**
     * Store employee data
     *
     * @param StoreEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeEmployee(StoreEmployeeRequest $request)
    {
        $this->companyService->storeEmployee($request->all());

        return redirect()->route('home');
    }

    /**
     * Delete employee
     *
     * @param DeleteEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEmployee(DeleteEmployeeRequest $request)
    {
        $this->companyService->deleteEmployee($request->id);

        return redirect()->back();
    }

    /**
     * Add comment
     *
     * @param StoreCommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment(StoreCommentRequest $request)
    {
        $this->companyService->addComment($request->all());

        return redirect()->back();
    }
}
