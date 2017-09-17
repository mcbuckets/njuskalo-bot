<?php

namespace Src;

use Buzz\Browser;

class NjuskaloBot
{
    public function checkForNewApartments()
    {
        $browser = new Browser();

        foreach(SEARCH_URLS as $url){
            $request = $browser->get($url);

            $matches = [];

            $result = preg_match('@datetime\="(.*?)"@', $request->getContent(), $matches);

            if($result == 1){
                $time = date("U", strtotime($matches[1]));
                $fiveMinAgo = time() - 60 * 5;

                if($time > $fiveMinAgo){

                    $this->sendNotificationMail(new MailgunEmailer(
                        "New apartments found!",
                        'Check new <a href="'.$url.'">apartments</a>',
                        RECIPIENTS
                    ));

                }
            }
        }
    }

    private function sendNotificationMail(MailgunEmailer $mailer)
    {
        try {
            $mailer->callMailgun();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
