<?php

require 'lines.php';

function assertEqual($val1, $val2, $i)
{
    if ($val1 !== $val2)
        echo "$i-FAIL '$val1' !== '$val2'\n";
    else
        echo "$i-PASS\n";
}

$i = 0;

// lets start simple
$csv = <<<CSV
01/09/15
CBB
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/09/15,823,Akron,,5.0,195,o 136.5 (-110),6329,53%,41%,50%,,
  7:00PM,824,Toledo,6,-5.0,-230,u 136.5 (-110),,47%,59%,18%,,
CSV;

$result = LineInserter::processCsv($csv);
assertEqual(count($result), 2, $i++);
assertEqual($result[0]->team, 'Akron', $i++);
assertEqual($result[1]->team, 'Toledo', $i++);

// ok more complicated
$csv = <<<CSV
01/09/15
CBB
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/09/15,823,Akron,,5.0,195,o 136.5 (-110),6329,53%,41%,50%,,
  7:00PM,824,Toledo,6,-5.0,-230,u 136.5 (-110),,47%,59%,18%,,
NBA
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/09/15,801,Boston,,6.0(-115),205,o 196.5 (-110),1822,51%,75%,50%,,
  7:05PM,802,Indiana,,-6.0(-105),-245,u 196.5 (-110),,49%,25%,58%,,
CSV;

$result = LineInserter::processCsv($csv);
assertEqual(count($result), 4, $i++);
assertEqual($result[2]->team, 'Boston', $i++);
assertEqual($result[3]->team, 'Indiana', $i++);

// ok time for the real shit
$csv = <<<CSV
01/09/15
CBB
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/09/15,823,Akron,,5.0,195,o 136.5 (-110),6329,53%,41%,50%,,
  7:00PM,824,Toledo,6,-5.0,-230,u 136.5 (-110),,47%,59%,18%,,
01/09/15,825,Wis.-Green Bay,9½,-9.5,-500,o 128.0 (-104),5178,66%,86%,50%,,
  9:00PM,826,Wis.-Milwaukee,127,9.5,400,u 128.0 (-116),,34%,14%,16%,,
NBA
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/09/15,801,Boston,,6.0(-115),205,o 196.5 (-110),1822,51%,75%,50%,,
  7:05PM,802,Indiana,,-6.0(-105),-245,u 196.5 (-110),,49%,25%,58%,,
01/09/15,821,Orlando,202½,2.5(-115),115,o 198.5 (-110),6755,22%,37%,50%,,
 10:35PM,822,Los Angeles Lakers,4,-2.5(-105),-135,u 198.5 (-110),,78%,63%,41%,,
NHL
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/09/15,1,New York Islanders,-140/+120,-1.5(180),-170,o 5.0 (-120),2295,26%,65%,50%,,
  7:05PM,2,New Jersey,5o-130,1.5(-210),145,u 5.0 (100),,74%,35%,9%,,
01/10/15
CBB
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/10/15,713,Montana St.,,10.5, ,o   ( ),83,,,,,
  9:00PM,714,Weber St.,,-10.5, ,u   ( ),,,,,,
CFB
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/10/15,151,Illinois St.,,6.5, ,o 54.0 (-110),1480,14%,86%,50%,,
  1:00PM,152,N. Dakota St.,,-6.5, ,u 54.0 (-110),,86%,14%,18%,,
NFL
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/10/15,111,Baltimore,49,7.0(-120),255,o 47.5 (-110),40406,55%,24%,50%,,
  4:35PM,112,New England,7,-7.0(100),-310,u 47.5 (-110),,45%,76%,31%,,
01/10/15,113,Carolina,40½,11.5(-115),500,o 39.5 (-110),40366,38%,23%,50%,,
  8:15PM,114,Seattle,11½-105,-11.5(-105),-650,u 39.5 (-110),,62%,77%,64%,,
01/11/15
01/11/15,117,Dallas,53,5.5(-115),210,o 52.0 (-110),34794,52%,64%,50%,,
  1:05PM,118,Green Bay,6½-104,-5.5(-105),-250,u 52.0 (-110),,48%,36%,38%,,
01/11/15,119,Indianapolis,53,7.0(-115),250,o 54.0 (-110),32328,41%,25%,50%,,
  4:40PM,120,Denver,7½+100,-7.0(-105),-300,u 54.0 (-110),,59%,75%,38%,,
01/12/15
CFB
Date, #, Team, Open, Spread, ML, Total, Bet#, Spread%, ML%, Total%, Exotics
01/12/15,277,Ohio St.,74u-121,5.5(-115),175,o 74.5 (-110),48497,46%,60%,50%,,
  8:30PM,278,Oregon,7,-5.5(-105),-205,u 74.5 (-110),,54%,40%,50%,,
CSV;

$result = LineInserter::processCsv($csv);

assertEqual(count($result), 24, $i++);
assertEqual($result[10]->team, 'Montana St.', $i++);
assertEqual($result[22]->team, 'Ohio St.', $i++);

