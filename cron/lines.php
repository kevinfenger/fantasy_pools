<?php
// TODO - there is a PHP warning right now that should be cleaned up

class Line
{
    ////---------- REQUIRED PARAMETERS //----------

    // string A three character sport name (NBA, CBB, CFB, NFL, NHL, MLB, etc.)
    public $sport;
    // string The date the game will take place
    public $date;
    // int The pregrame.com ID of this line/bet NOTE: this will not be unique, pregame puts the over/unders along side the
    // spreads, I don't know why they do this - there may be a reason but I don't understand it, I am going to seperate
    // the over/under bets from the spreads AND the moneylines, at least for now
    public $pregameDotComLineID;
    // string The team name
    public $team;
    // string The bet type (SPREAD, ML, OU)
    public $betType;

    //---------- OPTIONAL PARAMATERS ----------
    // float|null The spread (can be a negative value), if null this is either a money line bet or a o/u bet
    public $spread;
    // int|null The money line (can be a negative value), if null this is either a spread bet or o/u bet
    public $moneyLine;
    // string|null The over/under ex: 'u 136.5 (-110)', if null this is either a spread bet or a moneyline bet
    public $overUnder; 
}

class LineInserter
{
    /**
     * Proccesses the csv file that we get from pregame.com into something we can easily put into the database
     *
     * @param string $csv The raw csv file to process
     *
     * @return array An array of values ready to be put into lines db rows
     */
    public function processCsv($csv)
    {
        // pregame.com repeats the date for each line and also has it at the start
        // of each 'day' remove the duplicated data to make our lives easier later on
        $csv = preg_replace('/(\d+)\/(\d+)\/(\d+)\n/i', '', $csv);

        $rawArray = array_map("str_getcsv", explode("\n", $csv));
        $allLinesArray = array();

        $i = 0;
        foreach($rawArray as $value)
        {
            // this indicates the start of a new sport 
            if (count($value) === 1)
                $i = 0;

            // the zeroth entry is the sport
            if ($i === 0)
                $sport = $value[0];

            // the first entry is headings, we don't care about that
            if ($i > 1)
            {
                // these are the actual lines
                $line = $value;
                $lineObject = self::setupLineObject($line, $sport);
                $allLinesArray[] = $lineObject;
            }
            $i++;
        }
        return $allLinesArray;
    }

    /*
     * Takes a pregame.com line array and returns a line object
     *
     * @param array $lineArray The line in array format, has all of our data besides the sport
     * @param string $sport The three character sport string ex: CBB
     *
     * @return Line A line object
     */
    public function setupLineObject($lineArray, $sport)
    {
        $lineObject = new Line();
        //Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
        $lineObject->sport = $sport;
        list($lineObject->date, $lineObject->pregameDotComLineID, $lineObject->team, $open, $lineObject->spread, $lineObject->moneyLine, $lineObject->overUnder, $betNumber, $spreadPercentage, $moneyLinePercentage, $totalPercentage, $exotics) = $lineArray;
             
        return $lineObject;
    }

    /**
     * Hits pregame.com for our data, we get it in csv format
     *
     * @return string A raw csv
     */
    public function hitPregame()
    {
        $ch = curl_init("http://pregame.com/sportsbook_spy/default.aspx");
        
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36                                                                    (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36",
        );
        curl_setopt_array($ch, $options);
        $eventTarget = urlencode('ctl00$content$ctl00$w_10412$_4e400085$ctl00$lbDownload');
        $eventArgument = '';
        $viewState = '%2FwEPDwUKMTgwNjUyODkwM2QYAQU3Y3RsMDAkY29udGVudCRjdGwwMCR3XzEwNDE0JF80ZTQwMDA4NSRjdGwwMCRncmRDb21tZW50cw88KwAMAQgCAWQ=';
        $gameDate = urlencode(date("m/d/Y"));
        $allowDownload = 1;
        $sport = 'all';

        curl_setopt($ch, CURLOPT_POSTFIELDS,"__EVENTTARGET=$eventTarget&__EVENTARGUMENT=$eventArgument&__VIEWSTATE=$viewState&ctl00%24content%24ctl00%24w_10412%24_4e400085%24ctl00%24txtGameDt=$gameDate&ctl00%24content%24ctl00%24w_10412%24_4e400085%24ctl00%24hdnAllowDownload=1&ctl00%24content%24ctl00%24w_10412%24_4e400085%24ctl00%24hfSport=$sport&ctl00%24content%24ctl00%24w_10412%24_4e400085%24ctl00%24hfCal=0&ctl00%24content%24ctl00%24w_10414%24_4e400085%24ctl00%24txtComment=&ctl00%24content%24ctl00%24w_10414%24_4e400085%24ctl00%24hfParentId=0&ctl00%24content%24ctl00%24w_10414%24_4e400085%24ctl00%24hfReplyId=0&ctl00%24content%24ctl00%24w_10414%24_4e400085%24ctl00%24hfReportAbuse=0&ctl00%24content%24ctl00%24w_10414%24_4e400085%24ctl00%24hfIsLoggedIn=0");
    
       return curl_exec($ch);   
    }
}

//$csv = LineInserter::hitPregame();
//LineInserter::processCsv($csv);
