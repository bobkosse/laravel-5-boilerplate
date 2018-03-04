<?php
namespace App\Repositories\Backend\Auth;

use App\Exceptions\GeneralException;
use App\Models\Auth\Tenant;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class TenantRepository
 * @package App\Repositories\Backend\Auth
 */
class TenantRepository extends BaseRepository
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * TenantRepository constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

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
        }

        return DB::transaction(function () use ($tenant, $data) {
            if ($tenant->update([
                'tenant_name' => $data['tenant_name'],
                'active' => isset($data['active']) ? true : false,
                'end_subscription' => $data['end_subscription'],
                'max_users' => $data['max_users'],
            ])
            ) {
                return $tenant;
            }
            throw new GeneralException(trans('exceptions.backend.access.roles.update_error'));
        });
    }

    /**
     * Create a new tenant
     *
     * @param array $data
     * @return Tenant
     */
    public function create(array $data) : Tenant
    {
        return DB::transaction(function () use ($data) {
            $tenant = parent::create([
                'tenant_name' => $data['tenant_name'],
                'active' => isset($data['active']) ? true : false,
                'end_subscription' => $data['end_subscription'],
                'max_users' => $data['max_users'],
            ]);

            if ($tenant) {
                try {
                    $data['tenant_id'] = $tenant->id;
                    $data['useGivenTenantId'] = true;
                    $user = $this->userRepository->create($data);
                } catch(GeneralException $e) {
                    throw new GeneralException($e->getMessage());
                }

                return $tenant;
            }

            throw new GeneralException(__('exceptions.backend.access.tenant.create_error'));
        });
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