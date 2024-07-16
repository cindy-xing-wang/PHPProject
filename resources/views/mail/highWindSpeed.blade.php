<html>
    <h3>Hi Pyper Vision team:</h3>
    <p>
        This is a High Wind Speed notification from {{$mailDataLists[0]->airport_name}}. The notification details are as below:
        <p><strong>Airport name: </strong>{{$mailDataLists[0]->airport_name}}</p>
        <p><strong>Wind speed: </strong>{{$mailDataLists[0]->wind_speed}} knots</p>
        <p><strong>Temperature: </strong>{{$mailDataLists[0]->temperature}} &deg;C</p>
        <p><strong>Visibility: </strong>{{$mailDataLists[0]->visibility}} meters</p>
        <p><strong>Flight path: </strong>{{$mailDataLists[0]->flight_path_name}}</p>
        <p><strong>Drone: </strong>{{$mailDataLists[0]->drone_name}}</p>
        <p><strong>Pilot: </strong>{{$mailDataLists[0]->pilot_name}}</p>
        <p><strong>Support crews:</strong>
            @foreach ($mailDataLists as $mailData)
                <div>
                    {{$mailData->support_crew}}
                </div> 
            @endforeach
        </p>
        <p><strong>Log Note: </strong>{{$mailDataLists[0]->log_note}}</p>
        <p><strong>Created by: </strong>{{$mailDataLists[0]->created_by}}</p>
        <p><strong>Created at: </strong>{{$mailDataLists[0]->created_at}}</p>
        <br>
        <br>
        <p>Kind regards</p>
        <p><strong>{{$mailDataLists[0]->airport_name}} Airport</strong></p>
    </p>
</html>