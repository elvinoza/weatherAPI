<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\DiseaseModel;
use App\Models\DiseaseCondition;
use App\Enums\ClsfWeatherParameters;

class DiseaseConditionTest extends TestCase
{
    use DatabaseMigrations;

    protected $conditionId;
    protected $diseaseModel;

    public function setUp()
    {
        parent::setUp();

        $this->diseaseModel = factory(DiseaseModel::class)->create();
        $this->conditionId = null;
    }

    /**
     * Create Station Test.
     *
     * @return void
     */
    public function testCreateDiseaseModelCondition()
    {
        //$diseaseModel = factory(DiseaseModel::class)->create();

        $condition = $this->diseaseModel->conditions()->create([
            'disease_model_id' => $this->diseaseModel->id,
            'clsf_weather_parameter' => ClsfWeatherParameters::Temperature,
            'start_range' => 10,
            'end_range' => 20,
            'time' => 60
        ]);
        $this->conditionId = $condition->id;
        $found_disease_condition = DiseaseCondition::find($condition->id);

        $this->assertEquals(ClsfWeatherParameters::Temperature, $found_disease_condition->clsf_weather_parameter);
        $this->assertEquals(10, $found_disease_condition->start_range);
        $this->assertEquals(20, $found_disease_condition->end_range);
        $this->assertEquals(60, $found_disease_condition->time);

        $this->seeInDatabase('disease_conditions', [
            'id' => $condition->id,
            'clsf_weather_parameter' => $condition->clsf_weather_parameter,
            'start_range' => $condition->start_range,
            'end_range' => $condition->end_range,
            'time' => $condition->time
        ]);

        //$user->delete();
        //$found_station->delete();
    }

    /**
     * Delete Station Test.
     *
     * @return void
     */
    public function testDeleteDiseaseModelCondition()
    {
        //$user = factory(User::class)->create();

        $condition = $this->diseaseModel->conditions()->create([
            'disease_model_id' => $this->diseaseModel->id,
            'clsf_weather_parameter' => ClsfWeatherParameters::Temperature,
            'start_range' => 10,
            'end_range' => 20,
            'time' => 60
        ]);

        $this->seeInDatabase('disease_conditions', [
            'id' => $condition->id,
            'clsf_weather_parameter' => $condition->clsf_weather_parameter,
            'start_range' => $condition->start_range,
            'end_range' => $condition->end_range,
            'time' => $condition->time
        ]);

        DiseaseCondition::find($condition->id)->delete();

        $this->notSeeInDatabase('disease_conditions', [
            'id' => $condition->id,
            'clsf_weather_parameter' => $condition->clsf_weather_parameter,
            'start_range' => $condition->start_range,
            'end_range' => $condition->end_range,
            'time' => $condition->time
        ]);
    }

    public function tearDown()
    {
        if ($this->conditionId != null) {
            DiseaseCondition::find($this->conditionId)->delete();
        }

        $this->diseaseModel->delete();

        parent::tearDown();
    }
}
