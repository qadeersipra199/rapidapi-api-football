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
     * fixtures
     * Although the data is updated every 15 seconds, depending on the competition there may be a delay between reality and the availability of data in the API.
     * Update Frequency : This endpoint is updated every 15 seconds.
     * Recommended Calls : 1 call per minute for the leagues, teams, fixtures who have at least one fixture in progress otherwise 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Fixtures/operation/get-fixtures
     * You can pass single id or multiple ids using '-' seperator
     * @param  mixed $fixtureIds
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
    public static function rounds(string $leagueId, string $season, ?string $current = "false")
    {
        $queryParams = [
            'league' => $leagueId,
            'season' => $season,
            'current' => $current,
        ];
        return  FootballApi::callApi('fixtures/rounds?' . http_build_query($queryParams));
    }


    /**
     * fixturesByDate
     * Although the data is updated every 15 seconds, depending on the competition there may be a delay between reality and the availability of data in the API.
     * Update Frequency : This endpoint is updated every 15 seconds.
     * Recommended Calls : 1 call per minute for the leagues, teams, fixtures who have at least one fixture in progress otherwise 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Fixtures/operation/get-fixtures
     * @param  mixed $date
     * @return void
     */
    public static function fixturesByDate(string $date)
    {
        return  FootballApi::callApi('fixtures?date=' . $date);
    }

    /**
     * fixturesByTeam
     * Although the data is updated every 15 seconds, depending on the competition there may be a delay between reality and the availability of data in the API.
     * Update Frequency : This endpoint is updated every 15 seconds.
     * Recommended Calls : 1 call per minute for the leagues, teams, fixtures who have at least one fixture in progress otherwise 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Fixtures/operation/get-fixtures
     * @param  int $teamId
     * @param  int $season
     * @return void
     */
    public static function fixturesByTeam(int $teamId, int $season)
    {
        $queryParams = ['team' => $teamId, 'season' => $season];
        return  FootballApi::callApi('fixtures?' . http_build_query($queryParams));
    }
    /**
     * fixturesByTeam
     * Although the data is updated every 15 seconds, depending on the competition there may be a delay between reality and the availability of data in the API.
     * Update Frequency : This endpoint is updated every 15 seconds.
     * Recommended Calls : 1 call per minute for the leagues, teams, fixtures who have at least one fixture in progress otherwise 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Fixtures/operation/get-fixtures
     * @param  int $teamId
     * @param  int $season
     * @return void
     */
    public static function fixturesByLeague(int $leagueId, int $season)
    {
        $queryParams = ['league' => $leagueId, 'season' => $season];
        return  FootballApi::callApi('fixtures?' . http_build_query($queryParams));
    }

    /**
     * fixturesBetweenTwoDates
     * Although the data is updated every 15 seconds, depending on the competition there may be a delay between reality and the availability of data in the API.
     * Update Frequency : This endpoint is updated every 15 seconds.
     * Recommended Calls : 1 call per minute for the leagues, teams, fixtures who have at least one fixture in progress otherwise 1 call per day.  
     * Documentation : https://www.api-football.com/documentation-v3#tag/Fixtures/operation/get-fixtures
     * @param  mixed $leagueId
     * @param  mixed $season
     * @param  mixed $from
     * @param  mixed $to
     * @return void
     */
    public static function fixturesBetweenTwoDates(int $leagueId, int $season, string $from, string $to)
    {
        $queryParams = ['league' => $leagueId, 'season' => $season, 'from' => $from, 'to' => $to];
        return  FootballApi::callApi('fixtures?' . http_build_query($queryParams));
    }

    /**
     * fixturesByRound
     * Although the data is updated every 15 seconds, depending on the competition there may be a delay between reality and the availability of data in the API.
     * Update Frequency : This endpoint is updated every 15 seconds.
     * Recommended Calls : 1 call per minute for the leagues, teams, fixtures who have at least one fixture in progress otherwise 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Fixtures/operation/get-fixtures
     * @param  mixed $leagueId
     * @param  mixed $season
     * @param  mixed $round
     * @return void
     */
    public static function fixturesByRound(int $leagueId, int $season, string $round)
    {
        $queryParams = ['league' => $leagueId, 'season' => $season, 'round' => $round];
        return  FootballApi::callApi('fixtures?' . http_build_query($queryParams));
    }

    /**
     * fixturesByStatus
     * Although the data is updated every 15 seconds, depending on the competition there may be a delay between reality and the availability of data in the API.
     * Update Frequency : This endpoint is updated every 15 seconds.
     * Recommended Calls : 1 call per minute for the leagues, teams, fixtures who have at least one fixture in progress otherwise 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Fixtures/operation/get-fixtures
     * @param  mixed $leagueId
     * @param  mixed $season
     * @param  mixed $round
     * @return void
     */
    public static function fixturesByStatus(int $leagueId, int $season, string $status)
    {
        $queryParams = ['league' => $leagueId, 'season' => $season, 'status' => $status];
        return  FootballApi::callApi('fixtures?' . http_build_query($queryParams));
    }

    /**
     * nextXFixtures
     * Although the data is updated every 15 seconds, depending on the competition there may be a delay between reality and the availability of data in the API.
     * Update Frequency : This endpoint is updated every 15 seconds.
     * Recommended Calls : 1 call per minute for the leagues, teams, fixtures who have at least one fixture in progress otherwise 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Fixtures/operation/get-fixtures
     * @param  mixed $last
     * @return void
     */
    public static function lastXFixtures(int $last)
    {
        $queryParams = ['last' => $last];
        return  FootballApi::callApi('fixtures?' . http_build_query($queryParams));
    }
}
