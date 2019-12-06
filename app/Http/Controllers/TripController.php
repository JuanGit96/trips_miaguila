<?php

namespace App\Http\Controllers;

use App\Http\Traits\dataMongo;
use App\Http\Traits\apiResponser;
use App\Trip;
use Illuminate\Http\Request;


/**
* @OA\Info(title="API Trips", version="1.0")
*
* @OA\Server(url="http://localhost:8000")
*/

class TripController extends Controller
{
    use dataMongo;

    use apiResponser;


    /**
    * @OA\Get(
    *     path="/api/trips",
    *     summary="Mostrar todos los viajessss",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los viajes."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="error al listar viajes."
    *     )
    * )
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $trips = Trip::all();

            return $this->showAll($trips,200);
        }
        catch(\Exception $error)
        {
            return $this->errorResponse("error al listar viajes: $error",500);
        }

    }


    /**
    * @OA\Get(
    *     path="/api/trips/count",
    *     summary="Mostrar numero de viajes registrados",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar numero de viajes registrados."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="error al contar viajes."
    *     )
    * )
    */

    public function count()
    {
        try
        {
            $number_trips = Trip::all()->count();

            return $this->successResponse(["numero de viajes registrados" => $number_trips],200);
        }
        catch(\Exception $error)
        {
            return $this->errorResponse("error al contar viajes: $error",500);
        }

    }


    /**
    * @OA\Post(
    *     path="/api/trips/count/",
    *     summary="Mostrar numero de viajes por ciudad",
    *     @OA\Response(
    *         response=200,
    *         description="Contar viajes registrados por ciudad enviada."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="error al contar viajes por ciudad."
    *     ),
    *     @OA\Parameter(
    *         name="city",
    *         in="query",
    *         description="Ciudad para filtrar conteo",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *           @OA\Items(type="string"),    *
    *         ),
    *         style="form"
    *     ),
    * )
    */

    public function countByCity(Request $request)
    {
        try
        {
            $city = $request->city;

            $number_trips = Trip::where("city.name","=",$city)->count();

            return $this->successResponse(["numero de viajes registrados" => $number_trips],200);
        }
        catch(\Exception $error)
        {
            return $this->errorResponse("error al contar viajes por ciudad: $error",500);
        }

    }


    /**
    * @OA\Get(
    *     path="/api/trips/status/{trip_id}",
    *     summary="Estado de viaje",
    *     @OA\Response(
    *         response=200,
    *         description="Muestra estado de viaje enviado."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="error al mostrar status del viaje."
    *     ),
    *     @OA\Parameter(
    *         name="trip_id",
    *         in="path",
    *         description="id de registro de viaje",
    *         required=true,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    * )
    */

    public function statusByTrip($trip_id)
    {
        try
        {
            $trip = Trip::findOrFail($trip_id);

            $status = $trip["status"];

            return $this->successResponse($status,200);
        }
        catch(\Exception $error)
        {
            return $this->errorResponse("error al mostrar status del viaje: $error",500);
        }

    }



    /**
    * @OA\Post(
    *     path="/api/trips/",
    *     summary="Crear viaje",
    *     @OA\Response(
    *         response=200,
    *         description="viaje creado con exito."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="error al crear viaje."
    *     ),
    *     @OA\Parameter(
    *         name="start_date",
    *         in="query",
    *         description="fecha de inicio de viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="start_pickup_address",
    *         in="query",
    *         description="Direccion de entrega",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="start_location_type",
    *         in="query",
    *         description="Tipo de ubicación de inicio",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="start_longitude",
    *         in="query",
    *         description="longitud de inicio",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="start_latitude",
    *         in="query",
    *         description="latitud de inicio",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_date",
    *         in="query",
    *         description="fecha de fin del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_pickup_address",
    *         in="query",
    *         description="direccion de  final de entrega",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_pickup_location_type",
    *         in="query",
    *         description="tipo de localizacion del final del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_longitude",
    *         in="query",
    *         description="longitud de la direccion final",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_latitude",
    *         in="query",
    *         description="latitud de la direccion final",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="country_name",
    *         in="query",
    *         description="nombre del pais",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="city_name",
    *         in="query",
    *         description="ciudad del pais",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="passenger_first_name",
    *         in="query",
    *         description="primer nombre del pasajero",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="passenger_last_name",
    *         in="query",
    *         description="segundo nombre del pasajero",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_first_name",
    *         in="query",
    *         description="primernombre del conductor",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_last_name",
    *         in="query",
    *         description="segundo nombre del conductor",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="car_plate",
    *         in="query",
    *         description="matricula del carro",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="status_trip",
    *         in="query",
    *         description="status del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="check_code_trip",
    *         in="query",
    *         description="codigo de comprobacion del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="price_trip",
    *         in="query",
    *         description="precio del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_location_type",
    *         in="query",
    *         description="tipo de localizacion de conductor",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_location_longitude",
    *         in="query",
    *         description="longitud de localizacion de conductor",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_location_latitude",
    *         in="query",
    *         description="latitud de localizacion de longitud",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    * )
    */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->customData($request->all());

        $trip = new Trip($data);

        $created_trip = $trip->save();


        if($created_trip)
        {
            return $this->successResponse(["message"=>"viaje creado con exito",$trip],200);
        }

        return $this->errorResponse("error al crear viaje",500);

    }


    /**
    * @OA\Get(
    *     path="/api/trips/{trip_id}/",
    *     summary="Mostrar un viaje",
    *     @OA\Response(
    *         response=200,
    *         description="Visualiza data de viaje seleccionado."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Viaje no encontrado."
    *     ),
    *     @OA\Parameter(
    *         name="trip_id",
    *         in="path",
    *         description="id de viaje que se quiere viusalizar",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *           @OA\Items(type="string"),
    *           format="string",
    *         ),
    *         style="form"
    *     ),
    * )
    */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $trip = Trip::findOrFail($id);

            return $this->successResponse($trip,200);
        }
        catch(\Exception $error)
        {
            return $this->errorResponse("Viaje no encontrado",500);
        }

    }


    /**
    * @OA\Put(
    *     path="/api/trips/{trip_id}",
    *     summary="Editar viaje",
    *     @OA\Response(
    *         response=200,
    *         description="Edita viaje con data enviada."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="error al actualizar viaje."
    *     ),
    *     @OA\Parameter(
    *         name="trip_id",
    *         in="path",
    *         description="id de viaje a actualizar/modificar",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="start_date",
    *         in="query",
    *         description="fecha de inicio de viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="start_pickup_address",
    *         in="query",
    *         description="Direccion de entrega",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="start_location_type",
    *         in="query",
    *         description="Tipo de ubicación de inicio",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="start_longitude",
    *         in="query",
    *         description="longitud de inicio",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="start_latitude",
    *         in="query",
    *         description="latitud de inicio",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_date",
    *         in="query",
    *         description="fecha de fin del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_pickup_address",
    *         in="query",
    *         description="direccion de  final de entrega",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_pickup_location_type",
    *         in="query",
    *         description="tipo de localizacion del final del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_longitude",
    *         in="query",
    *         description="longitud de la direccion final",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="end_latitude",
    *         in="query",
    *         description="latitud de la direccion final",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="country_name",
    *         in="query",
    *         description="nombre del pais",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="city_name",
    *         in="query",
    *         description="ciudad del pais",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="passenger_first_name",
    *         in="query",
    *         description="primer nombre del pasajero",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="passenger_last_name",
    *         in="query",
    *         description="segundo nombre del pasajero",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_first_name",
    *         in="query",
    *         description="primernombre del conductor",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_last_name",
    *         in="query",
    *         description="segundo nombre del conductor",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="car_plate",
    *         in="query",
    *         description="matricula del carro",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="status_trip",
    *         in="query",
    *         description="status del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="check_code_trip",
    *         in="query",
    *         description="codigo de comprobacion del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="price_trip",
    *         in="query",
    *         description="precio del viaje",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_location_type",
    *         in="query",
    *         description="tipo de localizacion de conductor",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_location_longitude",
    *         in="query",
    *         description="longitud de localizacion de conductor",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    *     @OA\Parameter(
    *         name="driver_location_latitude",
    *         in="query",
    *         description="latitud de localizacion de longitud",
    *         required=false,
    *         @OA\Schema(
    *           type="string"
    *         ),
    *         style="form"
    *     ),
    * )
    */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

        $trip = $this->newData($trip,$request->all());

        $updated_trip = $trip->save();

        if($updated_trip)
        {
            return $this->successResponse(["message"=>"viaje actualizado con exito",$trip],200);
        }

        return $this->errorResponse("error al actualizar viaje",500);
    }



    /**
    * @OA\Delete(
    *     path="/api/trips/{trip_id}",
    *     summary="Eliminar viaje",
    *     @OA\Response(
    *         response=200,
    *         description="Eliminar viaje seleccionado."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="error al eliminar viaje."
    *     ),
    *     @OA\Parameter(
    *         name="trip_id",
    *         in="path",
    *         description="id del viaje que se desea eliminar",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *           @OA\Items(type="string"),    *
    *         ),
    *         style="form"
    *     ),
    * )
    */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);

        $deleted_trip = $trip->delete();

        if($deleted_trip)
        {
            return $this->successResponse(["message"=>"viaje eliminado con exito"],200);
        }

        return $this->errorResponse("error al eliminar viaje",500);
    }
}
