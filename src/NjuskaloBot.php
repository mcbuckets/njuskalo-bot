<?php

namespace Src;

use Buzz\Browser;

class NjuskaloBot
{
    public function checkForNewApartments()
    {
        $browser = new Browser();

        $request = $browser->get(SEARCH_URL);
        $matches = [];

        preg_match('@datetime\="(.*?)"@', $request->getContent(), $matches);
        d($matches[1]);
        $time = date("U", strtotime($matches[1]));
        $fiveMinBefore = time() - 60 * 10000;

        if($time > $fiveMinBefore){

            $this->sendNotificationMail(new MailgunEmailer(
                "New apartments found!",
                "Check new <a href='".SEARCH_URL."'>apartments</a>",
                RECIPIENTS
            ));

            return;
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
