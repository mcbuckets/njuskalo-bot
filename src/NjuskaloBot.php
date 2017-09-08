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

        $time = date("U", strtotime($matches[1]));
        $fiveMinAgo = time() - 60 * 5;

        if($time > $fiveMinAgo){

            $this->sendNotificationMail(new MailgunEmailer(
                "New apartments found!",
                'Check new <a href="'.SEARCH_URL.'">apartments</a>',
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
