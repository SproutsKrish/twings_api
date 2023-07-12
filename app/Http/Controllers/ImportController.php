<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\Device;
use Illuminate\Http\Request;

use App\Models\Sim;


class ImportController extends Controller
{
    public function sim_import(Request $request)
    {
        $filePath = $request->input('file_path');

        // dd($filePath);

        if ($filePath) {
            $path = $filePath;

            $data = array_map('str_getcsv', file($path));

            foreach ($data as $row) {
                Sim::create([
                    'network_id' => $row[0],
                    'sim_imei_no' => $row[1],
                    'sim_mob_no' => $row[2],
                    'valid_from' => $row[3],
                    'valid_to' => $row[4],
                    'purchase_date' => $row[5],
                    'status' => $row[9],
                    'created_by' => $row[13]
                ]);
            }

            return response()->json(['message' => 'CSV file imported successfully']);
        }

        return response()->json(['error' => 'No file path provided'], 400);
    }

    public function device_import(Request $request)
    {
        $filePath = $request->input('file_path');

        // dd($filePath);

        if ($filePath) {
            $path = $filePath;

            $data = array_map('str_getcsv', file($path));

            foreach ($data as $row) {
                Device::create([
                    'supplier_id' => $row[0],
                    'device_type_id' => $row[1],
                    'device_category_id' => $row[2],
                    'device_model_id' => $row[3],
                    'device_imei_no' => $row[4],
                    'ccid' => $row[5],
                    'uid' => $row[6],
                    'start_date' => $row[7],
                    'end_date' => $row[8],
                    'sensor_name' => $row[9],
                    'purchase_date' => $row[10],
                    'status' => $row[14],
                    'created_by' => $row[18]
                ]);
            }

            return response()->json(['message' => 'CSV file imported successfully']);
        }

        return response()->json(['error' => 'No file path provided'], 400);
    }


    public function camera_import(Request $request)
    {
        $filePath = $request->input('file_path');

        // dd($filePath);

        if ($filePath) {
            $path = $filePath;

            $data = array_map('str_getcsv', file($path));

            foreach ($data as $row) {
                Camera::create([
                    'supplier_id' => $row[0],
                    'camera_type_id' => $row[1],
                    'camera_category_id' => $row[2],
                    'camera_model_id' => $row[3],
                    'serial_no' => $row[4],
                    'id_no' => $row[5],
                    'purchase_date' => $row[6],
                    'status' => $row[10],
                    'created_by' => $row[14]
                ]);
            }

            return response()->json(['message' => 'CSV file imported successfully']);
        }

        return response()->json(['error' => 'No file path provided'], 400);
    }
}
