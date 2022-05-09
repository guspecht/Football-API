<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Football Api Documentation</title>
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Service endpoint</h1>
                    <p>A service endpoint is a base URL that specifies the network address of an API service. One service may have multiple service endpoints. This service has the following service endpoint and all URIs below are relative to this service endpoint:</p>
                    <ul>
                        <li>
                            http://football.test.au/
                        </li>
                    </ul>

                    <h1>REST Resource:v1.teams</h1>
                    <table class="table table-hover">
                        <tr>
                            <th>Methods</th>
                            <th>Endpoint</th>
                            <th>Description</th>
                        </tr>
                        <tr>
                            <th>getTeams</th>
                            <th>GET /api/football/v1/teams</th>
                            <th>Get all teams.</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
