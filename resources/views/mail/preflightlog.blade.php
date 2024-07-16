<html>
    <h3>Hi Pyper Vision team:</h3>
    <p>
        {{-- {{dd($mailDataLists['opsData'][0]->airport_name)}} --}}
        This is a pre-flight incompleted notification from {{$mailDataLists['opsData'][0]->airport_name}}. The notification details are as below:
        <p><strong>Airport name: </strong>{{$mailDataLists['opsData'][0]->airport_name}}</p>
        <p><strong>Wind speed: </strong>{{$mailDataLists['opsData'][0]->wind_speed}} knots</p>
        <p><strong>Temperature: </strong>{{$mailDataLists['opsData'][0]->temperature}} &deg;C</p>
        <p><strong>Visibility: </strong>{{$mailDataLists['opsData'][0]->visibility}} meters</p>
        <p><strong>Flight path: </strong>{{$mailDataLists['opsData'][0]->flight_path_name}}</p>
        <p><strong>Drone: </strong>{{$mailDataLists['opsData'][0]->drone_name}}</p>
        <p><strong>Pilot: </strong>{{$mailDataLists['opsData'][0]->pilot_name}}</p>
        <p><strong>Support crews:</strong>
            @foreach ($mailDataLists['opsData'] as $mailData)
                <div>
                    {{$mailData->support_crew}}
                </div> 
            @endforeach
        </p>
        <p><strong>Operation Log Note: </strong>{{$mailDataLists['opsData'][0]->log_note}}</p>
        <p><strong>Pre-flight checklist tasks completed:</strong>
            @foreach ($mailDataLists['preFlightData'] as $mailData)
                <div>
                    {{$mailData->name}}
                </div> 
            @endforeach
        </p>
        <p><strong>Pre-flight Log Note: </strong>{{$mailDataLists['preFlightData'][0]->pre_flight_logNote}}</p>
        <p><strong>Created by: </strong>{{$mailDataLists['opsData'][0]->created_by}}</p>
        <p><strong>Created at: </strong>{{$mailDataLists['opsData'][0]->created_at}}</p>
        <br>
        <br>
        <p>Kind regards</p>
        <p><strong>{{$mailDataLists['opsData'][0]->airport_name}} Airport</strong></p>
    </p>
</html>