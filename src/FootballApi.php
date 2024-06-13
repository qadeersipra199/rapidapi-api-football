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
     * lasXFixtures
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


    /**
     * teamsStatistics
     * Returns the statistics of a team in relation to a given competition and season. 
     * It is possible to add the date parameter to calculate statistics from the beginning of the season to the given date. By default the API returns the statistics of all games played by the team for the competition and the season.
     * Update Frequency : This endpoint is updated twice a day.
     * Recommended Calls : 1 call per day for the teams who have at least one fixture during the day otherwise 1 call per week.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams-statistics
     * @param  mixed $leagueId
     * @param  mixed $season
     * @param  mixed $teamId
     * @param  mixed $date
     * @return void
     */
    public static function teamsStatistics(int $leagueId, int $season, int $teamId, ?string $date)
    {
        $queryParams = ['league' => $leagueId, 'season' => $season, 'team' => $teamId];
        if ($date)
            $queryParams['date'] = $date;
        return  FootballApi::callApi('teams/statistics?' . http_build_query($queryParams));
    }


    /**
     * getTeamInformation
     * The team id are unique in the API and teams keep it among all the leagues/cups in which they participate.
     * Update Frequency : This endpoint is updated several times a week.
     * Recommended Calls : 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams
     *
     * @param  mixed $teamId
     * @return void
     */
    public static function team(int $teamId)
    {
        $queryParams = ['team' => $teamId];
        return  FootballApi::callApi('teams?' . http_build_query($queryParams));
    }


    /**
     * allTeams
     * The team id are unique in the API and teams keep it among all the leagues/cups in which they participate.
     * Update Frequency : This endpoint is updated several times a week.
     * Recommended Calls : 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams
     *
     * @param  mixed $teamId
     * @return void
     */
    public static function allTeams()
    {
        return  FootballApi::callApi('teams');
    }

    /**
     * getTeamsByLeague
     * The team id are unique in the API and teams keep it among all the leagues/cups in which they participate.
     * Update Frequency : This endpoint is updated several times a week.
     * Recommended Calls : 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams
     * @param  mixed $leagueId
     * @param  mixed $season
     * @return void
     */
    public static function getTeamsByLeague(int $leagueId, int $season)
    {
        $queryParams = ['league' => $leagueId, 'season' => $season];
        return  FootballApi::callApi('teams?' . http_build_query($queryParams));
    }

    /**
     * getTeamsByCountry
     * The team id are unique in the API and teams keep it among all the leagues/cups in which they participate.
     * Update Frequency : This endpoint is updated several times a week.
     * Recommended Calls : 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams
     * @param  mixed $country
     * @return void
     */
    public static function getTeamsByCountry(string $country)
    {
        $queryParams = ['country' => $country];
        return  FootballApi::callApi('teams?' . http_build_query($queryParams));
    }


    /**
     * getTeamsByCode
     * The team id are unique in the API and teams keep it among all the leagues/cups in which they participate.
     * Update Frequency : This endpoint is updated several times a week.
     * Recommended Calls : 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams
     * @param  mixed $code
     * @return void
     */
    public static function getTeamsByCode(string $code)
    {
        $queryParams = ['code' => $code];
        return  FootballApi::callApi('teams?' . http_build_query($queryParams));
    }


    /**
     * getTeamsByVenu
     * The team id are unique in the API and teams keep it among all the leagues/cups in which they participate.
     * Update Frequency : This endpoint is updated several times a week.
     * Recommended Calls : 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams
     * @param  mixed $leagueId
     * @param  mixed $season
     * @return void
     */
    public static function getTeamsByVenu(int $venueId)
    {
        $queryParams = ['venue' => $venueId];
        return  FootballApi::callApi('teams?' . http_build_query($queryParams));
    }


    /**
     * getTeamsByCountry
     * The team id are unique in the API and teams keep it among all the leagues/cups in which they participate.
     * Update Frequency : This endpoint is updated several times a week.
     * Recommended Calls : 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams
     * @param  mixed $leagueId
     * @param  mixed $season
     * @return void
     */
    public static function searchTeam(string $searchKeyword)
    {
        $queryParams = ['search' => $searchKeyword];
        return  FootballApi::callApi('teams?' . http_build_query($queryParams));
    }



    /**
     * Get the list of seasons available for a team.
     * This endpoint requires at least one parameter.
     * Update Frequency : This endpoint is updated several times a week.
     * Recommended Calls : 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams-seasons
     *
     * @param  mixed $teamId
     * @return void
     */
    public static function getTeamSeason($teamId)
    {
        $queryParams = ['team' => $teamId];
        return  FootballApi::callApi('teams/seasons?' . http_build_query($queryParams));
    }
    /**
     * Get the list of countries available for the teams endpoint.
     * Update Frequency : This endpoint is updated several times a week.
     * Recommended Calls : 1 call per day.
     * Documentation : https://www.api-football.com/documentation-v3#tag/Teams/operation/get-teams-countries
     * @return void
     */
    public static function getTeamCountries()
    {
        return  FootballApi::callApi('teams/countries');
    }
}
