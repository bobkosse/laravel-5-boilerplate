<?php

namespace App\Http\Controllers\Backend\Auth\Tenant;

use App\Events\Backend\Auth\Tenant\TenantCreated;
use App\Events\Backend\Auth\Tenant\TenantDeleted;
use App\Events\Backend\Auth\Tenant\TenantUpdated;
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

/**
 * Class TenantController
 * @package App\Http\Controllers\Backend\Auth\Tenant
 */
class TenantController extends Controller
{
    /**
     * @var TenantRepository
     */
    private $tenantRepository;

    /**
     * TenantController constructor.
     * @param TenantRepository $tenantRepository
     */
    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('backend.auth.tenant.index')
            ->withTenants($this->tenantRepository->getAllPaginated());
    }

    /**
     * @param Tenant $tenant
     * @return View
     */
    public function edit(Tenant $tenant): View
    {
        return view('backend.auth.tenant.edit')
            ->withTenant($tenant);
    }

    /**
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     * @return View
     */
    public function create(RoleRepository $roleRepository, PermissionRepository $permissionRepository): View
    {
        return view('backend.auth.tenant.create')
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param StoreTenantRequest $request
     * @return RedirectResponse
     */
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

        event(new TenantCreated($tenant));

        return redirect()->route('admin.auth.tenant.index')->withFlashSuccess(__('alerts.backend.tenant.created'));
    }

    /**
     * @param Tenant $tenant
     * @param UpdateTenantRequest $request
     * @return RedirectResponse
     */
    public function update(Tenant $tenant, UpdateTenantRequest $request): RedirectResponse
    {
        $this->tenantRepository->update($tenant, $request->only([
            'tenant_name'
        ]));
        event(new TenantUpdated($tenant));

        return redirect()->route('admin.auth.tenant.index')->withFlashSuccess(__('alerts.backend.tenant.updated'));
    }

    /**
     * @param Tenant $tenant
     * @return RedirectResponse
     */
    public function destroy(Tenant $tenant): RedirectResponse
    {
        $this->tenantRepository->deleteById($tenant->id);
        event(new TenantDeleted($tenant));

        return redirect()->route('admin.auth.tenant.index')->withFlashSuccess(__('alerts.backend.tenant.deleted'));
    }
}
