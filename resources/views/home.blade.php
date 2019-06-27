@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Calendario</h5>
                    <p class="card-category">Horarios</p>
                </div>
                <div class="card-body ">
                    <div class="calendar" id="calendar"></div>
                </div>

            </div>
        </div>
    </div>
@endsection



@section('scripts')
<script type="text/javascript">
        
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');



            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: {
                    url: '/api/calendar',
                    method: 'GET',
                    failure: function() {
                        alert('No se encontraron eventos');
                    },
                    color: 'yellow',   // a non-ajax option
                    textColor: 'black' // a non-ajax option
                },
                plugins: [ 'dayGrid' ],
                locale: 'es',
            });

            calendar.render();
        });

    
    </script>
    
@endsection