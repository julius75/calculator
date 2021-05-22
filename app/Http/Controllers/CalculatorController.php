<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CalculatorController extends Controller
{
    const add = 1,
        subtract = 2,
        multiply = 3,
        divide = 4;

    /**
     * Call the passed operation with the defined constant and return its result.
     * If the operation does not exist, return null.
     *
     * @param Request $request
     * @param int $operation
     * @param int $a
     * @param int $b
     * @return \Illuminate\Http\JsonResponse
     */
    public function vuvuzela(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'a' => 'required',
                'b' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        if ( $request->operation == null){
            return response()->json(['result' => 0]);
        }
        $a = $request->a;
        $b = $request->b;
        $operation = $request->operation;
        switch ($operation) {
            case 'add':
                //return $this->add($a, $b);
                return response()->json(['result' => $this->add($a, $b)]);
            case 'subtract':
                return response()->json(['result' => $this->subtract($a, $b)]);

            case 'multiply':
                return response()->json(['result' => $this->multiply($a, $b)]);

            case 'divide':
                if ($b == 0){
                    return response()->json(['result' => 0]);
                }
                return response()->json(['result' => $this->divide($a, $b)]);

            default:
                return response()->json(['result' => null]);
        }
    }
    /**
     * Sum the given numbers and return the result.
     *
     * @param  int $a
     * @param  int $b
     * @return int
     */
    public function add(int $a, int $b): int
    {
        return $a + $b;
    }

    /**
     * Subtract the second number from the first and return the result.
     *
     * @param  int $a
     * @param  int $b
     * @return int
     */
    public function subtract(int $a, int $b): int
    {
        return $a - $b;
    }

    /**
     * Multiply the given numbers and return the result.
     *
     * @param  int $a
     * @param  int $b
     * @return int
     */
    public function multiply(int $a, int $b): int
    {
        return $a * $b;
    }

    /**
     * Divide the first number by the second and return the result.
     *
     * @param  int $a
     * @param  int $b
     * @return int
     */
    public function divide(int $a, int $b): int
    {
        return floor($a / $b);
    }

    public function jina(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'jina' => 'required',

            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        try{
           $name = Name::create([
                'name'=>$request->jina,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            if ($name){
                return response()->json(['result' => 1]);
            }
        }
        catch (\Exception $exception){
            return response()->json(['result' => 2]);
        }
    }

}
