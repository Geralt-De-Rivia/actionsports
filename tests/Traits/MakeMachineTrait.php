<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\MachineModel;
use App\Repositories\MachineRepository;

trait MakeMachineTrait
{
    /**
     * Create fake instance of MachineModel and save it in database
     *
     * @param array $machineFields
     * @return MachineModel
     */
    public function makeMachine($machineFields = [])
    {
        /** @var MachineRepository $machineRepo */
        $machineRepo = \App::make(MachineRepository::class);
        $theme = $this->fakeMachineData($machineFields);
        return $machineRepo->create($theme);
    }

    /**
     * Get fake instance of MachineModel
     *
     * @param array $machineFields
     * @return MachineModel
     */
    public function fakeMachine($machineFields = [])
    {
        return new MachineModel($this->fakeMachineData($machineFields));
    }

    /**
     * Get fake data of MachineModel
     *
     * @param array $machineFields
     * @return array
     */
    public function fakeMachineData($machineFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $machineFields);
    }
}
