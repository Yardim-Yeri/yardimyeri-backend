<?php

namespace App\Http\Controllers\API;

use App\Enums\HelpStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\HelpDataResource;
use App\Models\HelpData;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = (int) $request->input('limit', 20);
        $order_column = (string) $request->input('order_column', 'created_at');
        $order_direction = (string) $request->input('order_direction', 'desc');

        $collection = HelpData::filter()->orderBy($order_column, $order_direction)->paginate($limit);

        $success_count = HelpData::where('help_status', '=', 'Yardım Ulaştı')->count();
        $warning_count = HelpData::where('help_status', '=', 'Yardım Bekliyor')->count();
        $info_count = HelpData::where('help_status', '=', 'Yardım Geliyor')->count();

        $resource = HelpDataResource::collection($collection)->additional([
            'success_help_count' => $success_count,
            'pending_help_count' => $warning_count,
            'process_help_count' => $info_count
        ]);

        return $this->respondWithResourceCollection($resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $help_data = HelpData::find($id);

        if (empty($help_data)) {
            return $this->respondNotFound('Yardım Talebi Bulunamadı');
        }

        $resource = new HelpDataResource($help_data);

        return $this->respondWithResource($resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $help_status = (string) $request->input('help_status');

        if (empty($help_status) || !in_array($help_status, HelpStatusEnum::getAllValues())) {
            return $this->respondError('help_status parameter required', 422);
        }

        try {
            $help_data = HelpData::find($id);
            if (empty($help_data)) {
                return $this->respondNotFound('Yardım Talebi Bulunamadı');
            }

            $help_data->help_status = $help_status;
            $help_data->save();

            return $this->respondWithResource(new HelpDataResource($help_data));
        } catch (\Exception $ex) {
            return $this->respondInternalError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
