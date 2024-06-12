<?php



namespace Rapidapi\FootballApi;

use Exception;
use Illuminate\Support\Facades\Http;

class FootballApi
{
    /**
     * callApi
     *
     * @param  mixed $endPoint
     * @param  mixed $params
     * @return void
     */
    public static function callApi(string $endPoint, string $params = "")
    {
        try {

            $apiResponse = null;
            $url = config('footballapi.BASE_URL') . $endPoint . $params;
            $response = Http::withHeaders([
                "X-RapidAPI-Host" =>  config('footballapi.X_RapidAPI_Host'),
                "X-RapidAPI-Key" => config('footballapi.X_RapidAPI_KEY')
            ])->get($url);
            $statusCode = $response->status();
            if ($response->ok()) {

                $apiResponse = $response->json();
                $apiResponse['stauts_code'] = $statusCode;
                $apiResponse['exception'] = false;
            }
            return $apiResponse;
        } catch (Exception $th) {
            return ['status_code' => $th->getCode(), 'message' => $th->getMessage(), 'exception' => true];
        }
    }


    /**
     * Rreturn All the Live Fixtures
     *
     * @return void
     */
    public static function live()
    {
        return  FootballApi::callApi('fixtures?live=all');
    }

    /**
     * fixtureDetails
     *
     * @return void
     */
    public static function fixtures($fixtureIds)
    {
        return  FootballApi::callApi('fixtures?ids=' . $fixtureIds);
    }

    /**
     * headtohead
     * Get heads to heads between two teams.
     * Update Frequency : This endpoint is updated every 15 seconds.
     * Recommended Calls : 1 call per minute for the leagues, teams, fixtures who have at least one fixture in progress otherwise 1 call per day.
     * @return void
     */
    public static function headtohead(string $teamsKey)
    {
        return  FootballApi::callApi('fixtures/headtohead?h2h=' . $teamsKey);
    }

    /**
     * rounds
     * Get the rounds for a league or a cup.
     * The round can be used in endpoint fixtures as filters
     * Update Frequency : This endpoint is updated every day.
     * Recommended Calls : 1 call per day.
     * @param  mixed $league_id
     * @param  mixed $season
     * @param  mixed $season
     * @return void
     */
    public static function rounds(string $league_id, string $season, ? string $current = "false")
    {
        $queryParams = [
            'league' => $league_id,
            'season' => $season,    
            'current' => $current,
        ];
        return  FootballApi::callApi('fixtures/rounds?' . http_build_query($queryParams));
    }
}
