<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\AccessCode;
use App\Models\AccessType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelReader;

class AccessCodeRepository extends Repository
{
    protected $model;

    public function __construct()
    {
        return $this->model = new AccessCode();
    }

    public function createAccessCodeWithType(string $access_code_file)
    {
        try {
            DB::beginTransaction();
            AccessCode::where('status', AccessCode::AVAILABLE)->update(['status' => AccessCode::EXPIRED]);

            SimpleExcelReader::create($access_code_file, 'csv')
                ->noHeaderRow()
                ->getRows()
                ->each(function (array $row) {
                    $accessType = AccessType::updateOrCreate(['description' => Str::upper(trim($row[0]))]);

                    return $accessType->codes()->create(['codes' => $row[1]]);
                });
            DB::commit();
            $this->success(__('messages.import.success'));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error(__('messages.import.error'));
        }
    }
}
