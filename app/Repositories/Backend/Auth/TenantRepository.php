<?php
namespace App\Repositories\Backend\Auth;

use App\Exceptions\GeneralException;
use App\Models\Auth\Tenant;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TenantRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Tenant::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getAllPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * Update a tenant
     *
     * @param Tenant $tenant
     * @param array $data
     * @return mixed
     */
    public function update(Tenant $tenant, array $data)
    {
        if ($tenant->tenant_name != $data['tenant_name']) {
            if ($this->tenantExists($data['tenant_name'])) {
                throw new GeneralException('A tenant already exists with the name ' . $data['tenant_name']);
            }


            return DB::transaction(function () use ($tenant, $data) {
                if ($tenant->update([
                    'tenant_name' => $data['tenant_name'],
                ])
                ) {
                    return $tenant;
                }

                throw new GeneralException(trans('exceptions.backend.access.roles.update_error'));
            });
        }
    }

    /**
     * Check if tenant already exists in database
     *
     * @param $name
     *
     * @return bool
     */
    protected function tenantExists($tenant_name)
    {
        return $this->model
                ->where('tenant_name', $tenant_name)
                ->count() > 0;
    }
}