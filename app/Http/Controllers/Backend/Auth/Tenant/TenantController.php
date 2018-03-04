<?php

namespace App\Http\Controllers\Backend\Auth\Tenant;

use App\Events\Backend\Auth\Tenant\TenantDeleted;
use App\Http\Requests\Backend\Auth\Tenant\StoreTenantRequest;
use App\Http\Requests\Backend\Auth\Tenant\UpdateTenantRequest;
use App\Models\Auth\Tenant;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\RoleRepository;
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

    public function create(RoleRepository $roleRepository, PermissionRepository $permissionRepository): View
    {
        return view('backend.auth.tenant.create')
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    public function store(StoreTenantRequest $request): RedirectResponse
    {
        $this->tenantRepository->create($request->only([
            'tenant_name',
            'first_name',
            'last_name',
            'email',
            'password',
            'timezone',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'permissions'
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
        $this->tenantRepository->deleteById($tenant->id);
        event(new TenantDeleted($tenant));

        return redirect()->route('admin.auth.tenant.index')->withFlashSuccess(__('alerts.backend.tenant.deleted'));
    }
}
