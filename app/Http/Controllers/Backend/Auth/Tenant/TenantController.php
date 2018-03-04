<?php

namespace App\Http\Controllers\Backend\Auth\Tenant;

use App\Http\Requests\Backend\Auth\Tenant\StoreTenantRequest;
use App\Http\Requests\Backend\Auth\Tenant\UpdateTenantRequest;
use App\Models\Auth\Tenant;
use App\Repositories\Backend\Auth\TenantRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TenantController extends Controller
{
    private $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    public function index(): View
    {
        return view('backend.auth.tenant.index')
            ->withTenants($this->tenantRepository->getAllPaginated());
    }

    public function edit(Tenant $tenant): View
    {
        return view('backend.auth.tenant.edit')
            ->withTenant($tenant);
    }

    public function create(): View
    {
        return view('backend.auth.tenant.create');
    }

    public function store(StoreTenantRequest $request): RedirectResponse
    {
        $this->tenantRepository->create($request->only([
            'tenant_name'
        ]));

        return redirect()->route('admin.auth.tenant.index')->withFlashSuccess(__('alerts.backend.tenant.created'));
    }

    public function update(Tenant $tenant, UpdateTenantRequest $request): RedirectResponse
    {
        $this->tenantRepository->update($tenant, $request->only([
            'tenant_name'
        ]));

        return redirect()->route('admin.auth.tenant.index')->withFlashSuccess(__('alerts.backend.tenant.updated'));
    }

    public function destroy(Tenant $tenant): RedirectResponse
    {
//        if ($role->isAdmin()) {
//            return redirect()->route('admin.auth.role.index')->withFlashDanger(__('exceptions.backend.access.roles.cant_delete_admin'));
//        }
//
//        $this->roleRepository->deleteById($role->id);
//
//        event(new RoleDeleted($role));

        return redirect()->route('admin.auth.tenant.index')->withFlashSuccess(__('alerts.backend.tenant.deleted'));
    }
}
