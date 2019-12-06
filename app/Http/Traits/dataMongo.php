<?php namespace App\Http\Traits;

use Carbon\Carbon;

trait dataMongo
{
    public function customData($data)
    {
        $trip["start"] = [
            "date" => [
              'date' => (isset($data["start_date"])) ? $data["start_date"] : "null"
            ],
            "pickup_address" => (isset($data["start_pickup_address"])) ? $data["start_pickup_address"] : "null",
            "pickup_location" => [
              "type" => (isset($data["start_location_type"])) ? $data["start_location_type"] : "null",
              "coordinates" => [
                0 => (isset($data["start_longitude"])) ? $data["start_longitude"] : "null",
                1 => (isset($data["start_latitude"])) ? $data["start_latitude"] : "null",
              ]
            ]
        ];

        $trip["end"] = [
            "date" => (isset($data["end_date"])) ? $data["end_date"] : "null",
            "pickup_address" => (isset($data["end_pickup_address"])) ? $data["end_pickup_address"] : "null",
            "pickup_location" => [
              "type" => (isset($data["end_pickup_location_type"])) ? $data["end_pickup_location_type"] : "null",
              "coordinates" => [
                0 => (isset($data["end_longitude"])) ? $data["end_longitude"] : "null",
                1 => (isset($data["end_latitude"])) ? $data["end_latitude"] : "null",
              ]
            ]
        ];


        $trip["country"] = [
            "name" => (isset($data["country_name"])) ? $data["country_name"] : "null"
        ];


        $trip["city"] = [
            "name" => (isset($data["city_name"])) ? $data["city_name"] : "null"
        ];

        $trip["passenger"] = [
            "first_name" => (isset($data["passenger_first_name"])) ? $data["passenger_first_name"] : "null",
            "last_name" => (isset($data["passenger_last_name"])) ? $data["passenger_last_name"] : "null",
        ];

        $trip["driver"] = [
            "first_name" => (isset($data["driver_first_name"])) ? $data["driver_first_name"] : "null",
            "last_name" => (isset($data["driver_last_name"])) ? $data["driver_last_name"] : "null",
        ];

        $trip["car"] = [
            "plate" => (isset($data["car_plate"])) ? $data["car_plate"] : "null"
        ];

        $trip["status"] = (isset($data["status_trip"])) ? $data["status_trip"] : "null";

        $trip["check_code"] = (isset($data["check_code_trip"])) ? $data["check_code_trip"] : "null";

        $trip["createdAt"] = [
            'date' => Carbon::now()
        ];

        $trip["updatedAt"] = [
            'date' => "null"
        ];

        $trip["price"] = (isset($data["price_trip"])) ? $data["price_trip"] : "null";

        $trip["driver_location"] = [
            "type" => (isset($data["driver_location_type"])) ? $data["driver_location_type"] : "null",
            "coordinates" => [
              0 => (isset($data["driver_location_longitude"])) ? $data["driver_location_longitude"] : "null",
              1 => (isset($data["driver_location_latitude"])) ? $data["driver_location_latitude"] : "null",
            ]
        ];

        return $trip;
    }

    public function newData($trip, $data)
    {
        $trip["start"] = [
            "date" => [
              'date' => (isset($data["start_date"])) ? $data["start_date"] : isset($trip["start"]["date"]['$date'])?$trip["start"]["date"]['$date']:$trip["start"]["date"]['date']
            ],
            "pickup_address" => (isset($data["start_pickup_address"])) ? $data["start_pickup_address"] : $trip["start"]["pickup_address"],
            "pickup_location" => [
              "type" => (isset($data["start_pickup_location_type"])) ? $data["start_pickup_location_type"] : $trip["start"]["pickup_location"]["type"],
              "coordinates" => [
                0 => (isset($data["start_longitude"])) ? $data["start_longitude"] : $trip["start"]["pickup_location"]["coordinates"][0],
                1 => (isset($data["start_latitude"])) ? $data["start_latitude"] : $trip["start"]["pickup_location"]["coordinates"][1],
              ]
            ]
        ];

        $trip["end"] = [
            "date" => (isset($data["end_date"])) ? $data["end_date"] : $trip["end"]["date"],
            "pickup_address" => (isset($data["end_pickup_address"])) ? $data["end_pickup_address"] : $trip["end"]["pickup_address"],
            "pickup_location" => [
              "type" => (isset($data["end_pickup_location_type"])) ? $data["end_pickup_location_type"] : $trip["end"]["pickup_location"]["type"],
              "coordinates" => [
                0 => (isset($data["end_longitude"])) ? $data["end_longitude"] : $trip["end"]["pickup_location"]["coordinates"][0],
                1 => (isset($data["end_latitude"])) ? $data["end_latitude"] : $trip["end"]["pickup_location"]["coordinates"][1],
              ]
            ]
        ];


        $trip["country"] = [
            "name" => (isset($data["country_name"])) ? $data["country_name"] : $trip["country"]["name"]
        ];


        $trip["city"] = [
            "name" => (isset($data["city_name"])) ? $data["city_name"] : $trip["city"]["name"]
        ];

        $trip["passenger"] = [
            "first_name" => (isset($data["passenger_first_name"])) ? $data["passenger_first_name"] : $trip["passenger"]["first_name"],
            "last_name" => (isset($data["passenger_last_name"])) ? $data["passenger_last_name"] : $trip["passenger"]["last_name"],
        ];

        $trip["driver"] = [
            "first_name" => (isset($data["driver_first_name"])) ? $data["driver_first_name"] : $trip["driver"]["first_name"],
            "last_name" => (isset($data["driver_last_name"])) ? $data["driver_last_name"] : $trip["driver"]["last_name"],
        ];

        $trip["car"] = [
            "plate" => (isset($data["car_plate"])) ? $data["car_plate"] : $trip["car"]["plate"]
        ];

        $trip["status"] = (isset($data["status_trip"])) ? $data["status_trip"] : $trip["status"];

        $trip["check_code"] = (isset($data["check_code_trip"])) ? $data["check_code_trip"] : $trip["check_code"];

        $trip["createdAt"] = [
            'date' => $trip["createdAt"]['$date']
        ];

        $trip["updatedAt"] = [
            'date' => Carbon::now()
        ];

        $trip["price"] = (isset($data["price_trip"])) ? $data["price_trip"] : $trip["price"];

        $trip["driver_location"] = [
            "type" => (isset($data["driver_location_type"])) ? $data["driver_location_type"] : $trip["driver_location"]["type"],
            "coordinates" => [
              0 => (isset($data["driver_location_longitude"])) ? $data["driver_location_longitude"] : $trip["driver_location"]["coordinates"][0],
              1 => (isset($data["driver_location_latitude"])) ? $data["driver_location_latitude"] : $trip["driver_location"]["coordinates"][1],
            ]
        ];

        return $trip;
    }
}
