<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;
use App\Models\DiseaseModel;
use App\Models\DiseaseCondition;
use App\Enums\ClsfWeatherParameters;
use App\Enums\CompareOperators;

class DiseaseModelControllerTest extends TestCase
{
    use WithoutMiddleware;

    protected $user;
    protected $diseaseModelId;
    protected $conditionId;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->diseaseModelId = null;
        $this->conditionId = null;
    }

    /**
     * Create Disease Model Test.
     *
     * @return void
     */
    public function testCreateDiseaseModel()
    {
        $data = [
            'user_id' => $this->user->id,
            'name' => 'TestName',
            'description' => 'TestDescription'
        ];

        $response = $this->json('POST', '/api/disease/create', $data);
        $json = json_decode($response->response->getContent());
        $this->diseaseModelId = $json->id;
        $response->seeJson($data);
    }

    /**
     * Update Disease Model Test.
     *
     * @return void
     */
    public function testUpdateDiseaseModelWithoutConditions()
    {
        $diseaseModel = factory(DiseaseModel::class)->create();
        $this->diseaseModelId = $diseaseModel->id;
        $data = $diseaseModel['original'];
        $data['conditions'] = [];
        $data['name'] = 'ChangedName';

        $response = $this->json('POST', '/api/disease/update', $data);

        $response->seeJson([
            'name' => 'ChangedName'
        ]);
    }

    /**
     * Get All Disease Models Test.
     *
     * @return void
     */
    public function testAllDiseaseModels()
    {
        $diseaseModel = factory(DiseaseModel::class)->create();
        $this->diseaseModelId = $diseaseModel->id;

        $this->json('GET', '/api/diseases')->seeJson(['id' => $diseaseModel->id]);
    }

    /**
     * Get Exists Disease Model Test.
     *
     * @return void
     */
    public function testGetDiseaseModel()
    {
        $diseaseModel = factory(DiseaseModel::class)->create();
        $this->diseaseModelId = $diseaseModel->id;

        $this->json('GET', '/api/disease/' . $diseaseModel->id)->seeJson(['id' => $diseaseModel->id]);
    }

    /**
     * Get Not Exists Disease Model Test.
     *
     * @return void
     */
    public function testGetNotExistsDiseaseModel()
    {
        $this->json('GET', '/api/disease/' . 0)->seeJson([]);
    }

    /**
     * Create Disease Model Conditions Test. (Data range)
     *
     * @return void
     */
    public function testCreateDiseaseConditionsDataRange()
    {
        $diseaseModel = factory(DiseaseModel::class)->create();
        $this->diseaseModelId = $diseaseModel->id;

        $data = $diseaseModel['original'];
        $data['conditions'] = [$this->createDiseaseModelConditionsDataRange($diseaseModel)];

        $this->json('POST', '/api/disease/createConditions', $data)->seeJson(['success' => true]);
    }

    /**
     * Create Disease Model Conditions Test. (Constant)
     *
     * @return void
     */
    public function testCreateDiseaseConditionsConstant()
    {
        $diseaseModel = factory(DiseaseModel::class)->create();
        $this->diseaseModelId = $diseaseModel->id;

        $data = $diseaseModel['original'];
        $data['conditions'] = [$this->createDiseaseModelConditionsConstant($diseaseModel)];

        $this->json('POST', '/api/disease/createConditions', $data)->seeJson(['success' => true]);
    }

    private function createDiseaseModelConditionsDataRange($diseaseModel)
    {
        $condition = $diseaseModel->conditions()->create([
            'disease_model_id' => $diseaseModel->id,
            'clsf_weather_parameter' => ClsfWeatherParameters::Temperature,
            'start_range' => 10,
            'end_range' => 20,
            'time' => 60
        ]);

        $this->conditionId = $condition->id;

        return $condition;
    }

    private function createDiseaseModelConditionsConstant($diseaseModel)
    {
        $condition = $diseaseModel->conditions()->create([
            'disease_model_id' => $diseaseModel->id,
            'clsf_weather_parameter' => ClsfWeatherParameters::SoilHumidity,
            'operator' => CompareOperators::MoreThan,
            'constant' => 50,
            'time' => 20
        ]);

        $this->conditionId = $condition->id;

        return $condition;
    }

    public function tearDown()
    {
        if($this->diseaseModelId !=null)
            DiseaseModel::find($this->diseaseModelId)->delete();

        if($this->conditionId !=null)
            DiseaseCondition::find($this->conditionId)->delete();

        parent::tearDown();
    }
}
