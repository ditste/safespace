<?php

namespace App\Transformers;

use App\Models\UserPlan;
use App\Transformers\PlanTransformer;
use League\Fractal\TransformerAbstract;

class UserPlanTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(UserPlan $data): array
    {
        return [
            "start_date" => $data->start_date,
            "end_date" => $data->end_date,
            "transaction_id"=>$data->transaction_id,
            "payment_mode" => $data->payment_mode,
            "plan" => fractal()->item($data->plan)->transformWith(new PlanTransformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer())->toArray(),
        ];
    }
}
